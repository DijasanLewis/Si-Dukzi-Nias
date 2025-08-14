<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SI-DUKZI BPS Nias</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <h1 class="text-2xl font-bold mb-4">Pemenuhan Bukti Dukung ZI - BPS Kabupaten Nias</h1>
    <a href="{{ route('zi.sync') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-6 inline-block">Sinkronkan Status Folder</a>

    <table class="min-w-full bg-white border">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-2 px-4 border">Area Perubahan</th>
                <th class="py-2 px-4 border">Poin Penilaian</th>
                <th class="py-2 px-4 border">Aksi</th>
                <th class="py-2 px-4 border">Link & Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($checklists as $item)
                <tr>
                    <td class="py-2 px-4 border">{{ $item->area_perubahan }}</td>
                    <td class="py-2 px-4 border">{{ $item->poin_penilaian }}</td>
                    <td class="py-2 px-4 border">
                        <a href="https://drive.google.com/drive/folders/{{ $item->google_drive_folder_id }}" target="_blank" class="bg-green-500 text-white px-3 py-1 rounded">Buka Folder</a>
                    </td>
                    <td class="py-2 px-4 border">
                        @if ($item->status == 'Terisi')
                            <div class="flex items-center space-x-2">
                                <input type="text" id="link-{{ $item->id }}" value="https://drive.google.com/drive/folders/{{ $item->google_drive_folder_id }}" class="border p-1 rounded w-full bg-gray-50" readonly>
                                <button onclick="copyLink({{ $item->id }})" class="bg-yellow-500 text-white px-3 py-1 rounded">Copy</button>
                            </div>
                        @else
                            <span class="text-red-500">Folder Kosong</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Data ZI belum diinisiasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script>
        function copyLink(id) {
            const linkInput = document.getElementById('link-' + id);
            linkInput.select();
            document.execCommand('copy');
            alert('Link berhasil disalin!');
        }
    </script>
</body>
</html>