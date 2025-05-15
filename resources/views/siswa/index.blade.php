<x-app-layout>
    <div class="flex justify-center items-center  p-5">
        <div class="w-full max-w-7xl border border-black rounded-lg overflow-x-auto">
            <!-- Table -->
            <table class="w-full text-left min-w-[1000px]">
                <thead>
                    <tr>
                        <th class="px-8 py-3 border-b border-gray-400">UID Kartu</th>
                        <th class="px-8 py-3 border-b border-gray-400">Gambar</th>
                        <th class="px-8 py-3 border-b border-gray-400">Nama</th>
                        <th class="px-8 py-3 border-b border-gray-400">No Orang Tua</th>
                        <th class="px-8 py-3 border-b border-gray-400">Alamat</th>
                        <th class="px-8 py-3 border-b border-gray-400">Kelas</th>
                        <th class="px-8 py-3 border-b border-gray-400">Update</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswas as $siswa)
                        <tr>
                            <td class="px-8 py-5 border-b border-gray-400">{{ $siswa->uid_kartu }}</td>
                            <td class="px-8 py-5 border-b border-gray-400">
                                @if ($siswa->gambar)
                                    <img src="{{ asset('storage/gambar/' . $siswa->gambar) }}"
                                        class="object-cover border border-gray-300" width="50" height="50">
                                @else
                                    <span class="text-gray-500">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 border-b border-gray-400">{{ $siswa->nama ?? '-' }}</td>
                            <td class="px-8 py-5 border-b border-gray-400">{{ $siswa->nomor_orangtua ?? '-' }}</td>
                            <td class="px-8 py-5 border-b border-gray-400">{{ $siswa->alamat ?? '-' }}</td>
                            <td class="px-8 py-5 border-b border-gray-400">{{ $siswa->kelas ?? '-' }}</td>
                            <td class="px-8 py-5 border-b border-gray-400 text-blue-600">
                                <a href="{{ route('siswa.edit', $siswa->id) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
