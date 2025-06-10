<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Klinik Dashboard</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="bg-white text-gray-800 font-GabaritoRegular">
    <div class="flex h-screen">
        {{-- Sidebar --}}
        <aside class="w-26 bg-white p-4 flex flex-col items-center space-y-6">
            <div class="w-full flex justify-center items-center">
                <img src="{{ asset('assets/logo-clinic.png') }}" class="w-14" alt="">
            </div>
            <nav class="w-full flex flex-col justify-center items-center space-y-5">
                <a href="#" class="text-gray-500 hover:text-blue-600">
                    <div class="bg-yellow-400 p-1.5 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                            class="text-white" fill="currentColor"
                            class="icon icon-tabler icons-tabler-filled icon-tabler-layout-dashboard">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M9 3a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2zm0 12a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-2a2 2 0 0 1 2 -2zm10 -4a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2zm0 -8a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-2a2 2 0 0 1 2 -2z" />
                        </svg>
                    </div>
                </a>
                <a href="#" class="text-gray-500 hover:text-blue-600">
                    <div class="bg-blue-800 p-1.5 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                            class="text-white" fill="currentColor"
                            class="icon icon-tabler icons-tabler-filled icon-tabler-clipboard-text">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M17.997 4.17a3 3 0 0 1 2.003 2.83v12a3 3 0 0 1 -3 3h-10a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 2.003 -2.83a4 4 0 0 0 3.997 3.83h4a4 4 0 0 0 3.98 -3.597zm-2.997 10.83h-6a1 1 0 0 0 0 2h6a1 1 0 0 0 0 -2m0 -4h-6a1 1 0 0 0 0 2h6a1 1 0 0 0 0 -2m-1 -9a2 2 0 1 1 0 4h-4a2 2 0 1 1 0 -4z" />
                        </svg>
                    </div>
                </a>
                <a href="#" class="text-gray-500 hover:text-blue-600">
                    <div class="bg-blue-800 p-1.5 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" class="text-white"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-vaccine-bottle">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 3m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                            <path
                                d="M10 6v.98c0 .877 -.634 1.626 -1.5 1.77c-.866 .144 -1.5 .893 -1.5 1.77v8.48a2 2 0 0 0 2 2h6a2 2 0 0 0 2 -2v-8.48c0 -.877 -.634 -1.626 -1.5 -1.77a1.795 1.795 0 0 1 -1.5 -1.77v-.98" />
                            <path d="M7 12h10" />
                            <path d="M7 18h10" />
                            <path d="M11 15h2" />
                        </svg>
                    </div>
                </a>
                <a href="#" class="text-gray-500 hover:text-blue-600">
                    <div class="bg-blue-800 p-1.5 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" class="text-white"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-chart-histogram">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 3v18h18" />
                            <path d="M20 18v3" />
                            <path d="M16 16v5" />
                            <path d="M12 13v8" />
                            <path d="M8 16v5" />
                            <path d="M3 11c6 0 5 -5 9 -5s3 5 9 5" />
                        </svg>
                    </div>
                </a>
                <a href="#" class="text-gray-500 hover:text-blue-600">
                    <div class="bg-blue-800 p-1.5 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" class="text-white"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-settings-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M19.875 6.27a2.225 2.225 0 0 1 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" />
                            <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        </svg>
                    </div>
                </a>
                <a href="#" class="text-gray-500 hover:text-blue-600">
                    <div class="bg-blue-800 p-1.5 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" class="text-white"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-user-square-rounded">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" />
                            <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                            <path d="M6 20.05v-.05a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v.05" />
                        </svg>
                    </div>
                </a>
                <a href="#" class="text-gray-500 hover:text-blue-600">
                    <div class="bg-blue-800 p-1.5 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" class="text-white"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-logout-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                            <path d="M15 12h-12l3 -3" />
                            <path d="M6 15l-3 -3" />
                        </svg>
                    </div>
                </a>
            </nav>
        </aside>

        {{-- Content --}}
        <main class="flex-1 overflow-y-auto relative">
            <div class="w-full h-full pt-2 pe-3 pb-10">
                <div class="flex w-full h-full space-x-5 rounded-3xl bg-[#F0F3F9] shadow-lg p-10">
                    <div class="w-3/4">
                        <div
                            class="bg-white w-full h-52 rounded-2xl shadow-lg flex justify-between items-center p-5 relative overflow-visible">
                            <div class="flex flex-col justify-center items-start space-y-1">
                                <h3 class="font-GabaritoMedium text-blue-800 text-2xl">
                                    Hello, <span class="text-yellow-400">Nadya Niswa</span>
                                </h3>
                                <p class="font-GabaritoRegular text-gray-400">
                                    Have a nice day and don't forget to take care of your health!
                                </p>
                            </div>
                            <div class="relative">
                                <img src="{{ asset('assets/icon-dashboard.png') }}"
                                    class="w-[290px] -mt-[35px] z-10 relative" alt="">
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-5 mt-5">
                            <div
                                class="flex justify-center items-center space-x-5 w-full h-24 bg-white rounded-2xl shadow-lg p-5">
                                <img src="{{ asset('assets/icon-transaction.png') }}" alt="">
                                <div class="">
                                    <p class="font-GabaritoSemiBold text-[#4F9BF6] text-2xl">10 Transaction</p>
                                    <p class="font-GabaritoRegular text-gray-400 text-sm">Total Transaksi Hari Ini</p>
                                </div>
                            </div>
                            <div
                                class="flex justify-center items-center space-x-5 w-full h-24 bg-white rounded-2xl shadow-lg p-5">
                                <img src="{{ asset('assets/icon-doctor.png') }}" alt="">
                                <div class="">
                                    <p class="font-GabaritoSemiBold text-[#4F9BF6] text-2xl">7 Doctor</p>
                                    <p class="font-GabaritoRegular text-gray-400 text-sm">Total Dokter Aktif</p>
                                </div>
                            </div>
                            <div
                                class="w-full h-full flex flex-col justify-center items-center row-span-2 bg-white rounded-2xl shadow-lg p-5">
                                <div
                                    class="w-1/2 h-2/3 flex justify-center items-center bg-[#4F9BF6] p-5 rounded-xl mb-5">
                                    <p class="font-GabaritoSemiBold text-blue-900 text-7xl">5</p>
                                </div>
                                <p class="text-[#4F9BF6] text-xl font-GabaritoSemiBold">Nomor Antrian</p>
                                <p class="text-gray-400 text-sm font-GabaritoRegular">Nomor Antrian Saat Ini</p>
                            </div>
                            <div
                                class="flex justify-center items-center space-x-5 w-full h-24 bg-white rounded-2xl shadow-lg p-5">
                                <img src="{{ asset('assets/icon-obat.png') }}" alt="">
                                <div class="">
                                    <p class="font-GabaritoSemiBold text-[#4F9BF6] text-2xl">99 Obat</p>
                                    <p class="font-GabaritoRegular text-gray-400 text-sm">Jenis Obat tersedia</p>
                                </div>
                            </div>
                            <div
                                class="flex justify-center items-center space-x-5 w-full h-24 bg-white rounded-2xl shadow-lg p-5">
                                <img src="{{ asset('assets/icon-pasien.png') }}" alt="">
                                <div class="">
                                    <p class="font-GabaritoSemiBold text-[#4F9BF6] text-2xl">3 Pasien</p>
                                    <p class="font-GabaritoRegular text-gray-400 text-sm">Pasien Terdaftar</p>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-5 mt-5">
                            <div class="w-full h-80 bg-white rounded-2xl shadow-lg">
                                <canvas id="visitChart"></canvas>
                            </div>
                            <div
                                class="w-full h-80 flex flex-col justify-center items-center bg-white rounded-2xl shadow-lg p-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-users text-[#4F9BF6]">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                </svg>
                                <div class="mt-5">
                                    <p class="font-GabaritoSemiBold text-[#4F9BF6] text-4xl">5 Antrian</p>
                                    <p class="font-GabaritoRegular text-gray-500 text-lg">Total Antrian Saat Ini</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/4 bg-[#4F9BF6] h-full rounded-2xl p-5 shadow-lg space-y-5">
                        <div class="w-full h-1/3 bg-white rounded-2xl">

                        </div>
                        <div class="w-full h-[266px] bg-white rounded-2xl">
                            <div id="calendar" class="w-full h-full"></div>
                        </div>
                        <div class="w-full h-20 bg-[#F0F3F9AD] rounded-xl flex justify-between items-center p-5">
                            <img src="{{ asset('assets/icon-urologis.png') }}" width="65px" alt="">
                            <div class="flex flex-col justify-center items-start">
                                <p class="font-GabaritoSemiBold text-xl text-white">Urologis</p>
                                <p class="font-GabaritoSemiBold text-xl text-white">dr. Zoey Ananda</p>
                            </div>
                            <p class="font-GabaritoSemiBold text-xl text-white">10.30 PM</p>
                        </div>
                        <div class="w-full h-20 bg-[#F0F3F9AD] rounded-xl flex justify-between items-center p-5">
                            <img src="{{ asset('assets/icon-urologis.png') }}" width="65px" alt="">
                            <div class="flex flex-col justify-center items-start">
                                <p class="font-GabaritoSemiBold text-xl text-white">Urologis</p>
                                <p class="font-GabaritoSemiBold text-xl text-white">dr. Zayn Ananda</p>
                            </div>
                            <p class="font-GabaritoSemiBold text-xl text-white">14.30 PM</p>
                        </div>
                    </div>
                </div>
                <footer class="flex flex-col justify-center items-center mt-3">
                    <p class="font-GabaritoRegular text-sm">Developed by <span class="text-yellow-400">Nath</span></p>
                </footer>
            </div>
            @yield('content')
        </main>
    </div>
    <script>
        const ctx = document.getElementById('visitChart').getContext('2d');

        const visitChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($data['labels']),
                datasets: [{
                    label: 'Jumlah Kunjungan per Bulan',
                    data: @json($data['data']),
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderRadius: 10, // Rounded bar
                    borderSkipped: false // No flat top/bottom
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Statistik Kunjungan Klinik',
                        font: {
                            size: 20,
                            weight: '600'
                        },
                        color: '#333'
                    },
                    tooltip: {
                        backgroundColor: '#333',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        borderColor: '#ddd',
                        borderWidth: 1,
                        padding: 10
                    },
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#666',
                            font: {
                                size: 14
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 50,
                            color: '#666',
                            font: {
                                size: 14
                            }
                        },
                        grid: {
                            color: '#eee'
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Kunjungan',
                            color: '#333',
                            font: {
                                size: 14,
                                weight: '600'
                            }
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutBounce'
                }
            }
        });
    </script>

</body>

</html>
