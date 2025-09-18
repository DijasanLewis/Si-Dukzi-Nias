<?php

namespace App\Exports;

use App\Models\ZIChecklist;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class ChecklistExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(): Collection
    {
        // Ambil semua data checklist beserta relasi ke tabel petugas
        // agar kita bisa mendapatkan nama PIC (Petugas)
        return ZIChecklist::with('petugas')->get();
    }

    /**
    * Menentukan header untuk setiap kolom di file Excel.
    *
    * @return array
    */
    public function headings(): array
    {
        return [
            'Aspek',
            'Area',
            'Pilar',
            'Sub Pilar',
            'Pertanyaan',
            'Uraian',
            'Output',
            'Dokumen',
            'PIC',
            'Tim Kerja Terkait',
            'Link Bukti Dukung',
            'Permasalahan / Permintaan / Catatan',
            'Pemeriksa',
            'Hasil Pemeriksaan Tim Monitoring',
            'Catatan Hasil Pemeriksaan',
        ];
    }

    /**
    * Memetakan data dari setiap baris model ke format array yang diinginkan.
    *
    * @param mixed $checklist
    * @return array
    */
    public function map($checklist): array
    {
        // Ambil teks dari kolom rencana_aksi
        $rencanaAksi = $checklist->rencana_aksi ?? '';

        return [
            $checklist->aspek,
            $checklist->area,
            $checklist->pilar,
            $checklist->sub_pilar,
            $checklist->pertanyaan,
            $this->parseRencanaAksi($rencanaAksi, 'Uraian'),
            $this->parseRencanaAksi($rencanaAksi, 'Output'),
            $this->parseRencanaAksi($rencanaAksi, 'Dokumen'),
            $checklist->petugas->nama ?? 'N/A', // Ambil nama dari relasi
            $this->parseRencanaAksi($rencanaAksi, 'Tim Kerja Terkait'),
            $checklist->google_drive_folder_id ? 'https://drive.google.com/drive/folders/' . $checklist->google_drive_folder_id : 'N/A',
            $checklist->kendala,
            $this->parseRencanaAksi($rencanaAksi, 'Pemeriksa'),
            $checklist->status_pemeriksa,
            $checklist->catatan_pemeriksa,
        ];
    }

    /**
    * Fungsi bantuan untuk mem-parsing teks dari kolom rencana_aksi.
    * Mencari nilai berdasarkan Key yang diberikan (misal: "Uraian").
    *
    * @param string $text Teks lengkap dari rencana_aksi.
    * @param string $key  Key yang ingin dicari nilainya.
    * @return string
    */
    private function parseRencanaAksi(?string $text, string $key): string
    {
        if (empty($text)) {
            return '';
        }

        // Pola regex untuk mencari "Key: Value" dan mengambil "Value" nya.
        // \s* -> cocok dengan spasi (jika ada)
        // (.*?)   -> mengambil teks apapun (non-greedy)
        // (?:\n|$) -> berhenti mencari saat menemukan baris baru (\n) atau akhir dari teks ($)
        $pattern = '/' . preg_quote($key) . ':\s*(.*?)(?:\n|$)/';

        if (preg_match($pattern, $text, $matches)) {
            // $matches[1] berisi teks yang kita inginkan
            return trim($matches[1]);
        }

        return ''; // Kembalikan string kosong jika tidak ditemukan
    }
}