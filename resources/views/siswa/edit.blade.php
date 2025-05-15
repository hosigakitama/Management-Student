<x-app-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Edit Data Siswa</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block font-medium text-gray-700">UID Kartu</label>
                    <input type="text" class="w-full px-4 py-2 border rounded-md bg-gray-100 text-gray-700" value="{{ $siswa->uid_kartu }}" disabled>
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Nama</label>
                    <input type="text" name="nama" class="w-full px-4 py-2 border rounded-md" value="{{ $siswa->nama ?? '' }}" placeholder="Nama Siswa">
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Nomor Orang Tua</label>
                    <input type="text" name="nomor_orangtua" class="w-full px-4 py-2 border rounded-md" value="{{ $siswa->nomor_orangtua ?? '' }}" placeholder="Nomor Orang Tua">
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Alamat</label>
                    <textarea name="alamat" class="w-full px-4 py-2 border rounded-md" placeholder="Alamat">{{ $siswa->alamat ?? '' }}</textarea>
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Kelas</label>
                    <input type="text" name="kelas" class="w-full px-4 py-2 border rounded-md" value="{{ $siswa->kelas ?? '' }}" placeholder="Kelas">
                </div>

                <div>
                    <label class="block font-medium text-gray-700">Gambar</label>
                    @if ($siswa->gambar)
                        <img src="{{ asset('storage/gambar/' . $siswa->gambar) }}" class="w-24 h-24 rounded-md border border-gray-300 my-2">
                    @endif
                    <input type="file" name="gambar" class="w-full px-4 py-2 border rounded-md">
                </div>

                <div class="flex space-x-2">
                    <button type="submit" class="text-black px-4 py-2 font-bold">Simpan</button>
                    <a href="{{ route('siswa.index') }}" class="text-black px-4 py-2 rounded-md font-bold">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
