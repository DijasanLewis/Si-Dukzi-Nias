<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SI-DUKZI BPS Nias</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-4 md:p-8">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-2 text-gray-800">Pemenuhan Bukti Dukung Zona Integritas</h1>
        <p class="text-gray-600 mb-6">BPS Kabupaten Nias</p>

        <a href="{{ route('zi.sync') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded mb-6 inline-block transition duration-300">
            &#x21bb; Sinkronkan Status Folder
        </a>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="space-y-6">
            @foreach ($checklists as $aspek => $areas)
                <div class="border border-gray-300 rounded-lg overflow-hidden">
                    <h2 class="text-xl font-bold bg-gray-200 p-3 text-gray-700">{{ $aspek }}</h2>
                    <div class="p-4 space-y-4">
                        @foreach ($areas as $area => $pilars)
                            <div class="border border-blue-200 rounded-md">
                                <h3 class="text-lg font-semibold bg-blue-100 p-2 text-blue-800">{{ $area }}</h3>
                                <div class="p-3 space-y-3">
                                    @foreach ($pilars as $pilar => $subpilars)
                                        <div class="border-l-4 border-gray-400 pl-3">
                                            <h4 class="font-medium text-gray-800">{{ $pilar }}</h4>
                                            @foreach ($subpilars as $subpilar => $pertanyaans)
                                                <div class="ml-4 mt-2">
                                                    <p class="italic text-gray-600">{{ $subpilar }}</p>
                                                    <table class="min-w-full mt-1 border-t">
                                                        <tbody>
                                                            @foreach ($pertanyaans as $item)
                                                                <tr class="border-b hover:bg-gray-50">
                                                                    <td class="py-2 px-3 text-sm text-gray-700">{{ $item->pertanyaan }}</td>
                                                                    <td class="py-2 px-3 w-48 text-right">
                                                                        @if ($item->google_drive_folder_id)
                                                                            <div class="flex items-center justify-end space-x-2">
                                                                                <input type="text" id="link-{{ $item->id }}" value="https://drive.google.com/drive/folders/{{ $item->google_drive_folder_id }}" class="hidden">
                                                                                <button onclick="copyLink({{ $item->id }})" class="bg-gray-200 hover:bg-gray-300 text-gray-700 text-xs font-bold px-2 py-1 rounded" title="Salin Tautan">Copy</button>
                                                                                <a href="https://drive.google.com/drive/folders/{{ $item->google_drive_folder_id }}" target="_blank" class="bg-green-500 hover:bg-green-600 text-white text-xs font-bold px-2 py-1 rounded">Buka</a>
                                                                                <span class="w-16 text-center text-xs font-semibold rounded-full px-2 py-0.5 {{ $item->status == 'Terisi' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                                                                    {{ $item->status }}
                                                                                </span>
                                                                            </div>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function copyLink(id) {
            const linkInput = document.getElementById('link-' + id);
            linkInput.classList.remove('hidden'); // Tampilkan sementara untuk diseleksi
            linkInput.select();
            document.execCommand('copy');
            linkInput.classList.add('hidden'); // Sembunyikan kembali
            alert('Link berhasil disalin!');
        }
    </script>
</body>
</html>