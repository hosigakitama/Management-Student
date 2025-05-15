<x-app-layout>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Kehadiran Card -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                <div>
                    <p class="text-gray-600">Kehadiran</p>
                    <h2 class="text-3xl font-bold">3,782</h2>
                </div>
                <span class="text-green-600 bg-green-100 px-2 py-1 rounded-lg">▲ 11.01%</span>
            </div>

            <!-- Keterlambatan Card -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                <div>
                    <p class="text-gray-600">Keterlambatan</p>
                    <h2 class="text-3xl font-bold">5,359</h2>
                </div>
                <span class="text-red-600 bg-red-100 px-2 py-1 rounded-lg">▼ 9.05%</span>
            </div>

            <!-- Absen Sakit Card -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
                <div>
                    <p class="text-gray-600">Absen Sakit</p>
                    <h2 class="text-3xl font-bold">5,359</h2>
                </div>
                <span class="text-red-600 bg-red-100 px-2 py-1 rounded-lg">▼ 9.05%</span>
            </div>
        </div>

        <!-- Grafik Kehadiran Bulanan -->
        <div class="bg-white p-6 rounded-lg shadow-md mt-6">
            <p class="text-gray-600">Kehadiran Bulanan</p>
            <canvas id="attendanceChart"></canvas>
        </div>
    </div>

    <!-- Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Grafik Batang Kehadiran Bulanan
        const ctx = document.getElementById('attendanceChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Kehadiran',
                    data: [100, 350, 180, 290, 150, 200, 270, 130, 220, 370, 260, 90],
                    backgroundColor: 'blue'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Grafik Donut Target Kehadiran
        const ctx2 = document.getElementById('progressChart').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [75, 25],
                    backgroundColor: ['blue', '#e0e0e0']
                }]
            },
            options: {
                cutout: '80%'
            }
        });
    </script>
</x-app-layout>
