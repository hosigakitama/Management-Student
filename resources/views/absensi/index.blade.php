<x-app-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-3xl text-gray-800 mb-6 font-semibold">Riwayat Absensi Siswa</h2>

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-4">
            <table class="w-full text-left border-collapse table-auto">
                <thead class="bg-indigo-600 text-white">
                    <tr>
                        <th scope="col" class="py-3 px-4 text-sm font-semibold text-left">
                            Nomor
                        </th>
                        <th scope="col" class="py-3 px-4 text-sm font-semibold text-left">
                            Nama
                        </th>
                        <th scope="col" class="py-3 px-4 text-sm font-semibold text-left">
                            Class
                        </th>
                        <th scope="col" class="py-3 px-4 text-sm font-semibold text-left">
                            Users
                        </th>
                        <th scope="col" class="py-3 px-4 text-sm font-semibold text-left">
                            Jam Masuk
                        </th>
                        <th scope="col" class="py-3 px-4 text-sm font-semibold text-left">
                            Status
                        </th>
                        <th scope="col" class="py-3 px-4 text-sm font-semibold text-left">
                            Jam Keluar
                        </th>
                    </tr>
                </thead>
                <tbody id="absensi-table" class="divide-y bg-gray-50">
                    <!-- Data will be dynamically loaded -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function loadAbsensi() {
            $.ajax({
                url: "{{ route('get.absensi') }}",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    let rows = "";
                    $.each(response, function(index, data) {
                        let statusClass = data.status === 'Terlambat' ?
                            'inline-flex items-center px-3 py-1 text-red-500 rounded-full gap-x-2 bg-red-100' :
                            'inline-flex items-center px-3 py-1 text-emerald-500 rounded-full gap-x-2 bg-emerald-100';

                        let jamPulang = data.jam_pulang ? data.jam_pulang : '-';

                        rows += `
                            <tr class="hover:bg-indigo-50 transition duration-300 ease-in-out">
                                <td class="px-6 py-4 border text-gray-700 text-sm">${index + 1}</td>
                                <td class="px-6 py-4 border text-gray-900 font-medium">${data.siswa.nama}</td>
                                <td class="px-6 py-4 border text-gray-700 text-sm">${data.siswa.kelas}</td>
                                <td class="px-6 py-4 border text-gray-700 text-sm">${new Date(data.tanggal).toLocaleDateString('id-ID')}</td>
                                <td class="px-6 py-4 border text-gray-700 text-sm">${data.jam_masuk}</td>
                                <td class="px-6 py-4 border">
                                    <span class="${statusClass}">${data.status}</span>
                                </td>
                                <td class="px-6 py-4 border text-gray-700 text-sm">${jamPulang}</td>
                            </tr>
                        `;
                    });
                    $("#absensi-table").html(rows);
                }
            });
        }

        $(document).ready(function() {
            loadAbsensi(); // Load data initially
            setInterval(loadAbsensi, 5000); // Refresh every 5 seconds
        });
    </script>
</x-app-layout>
