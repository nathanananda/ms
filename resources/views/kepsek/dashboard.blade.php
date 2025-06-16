@extends('kepsek.layout.layout')

@section('content-user')
    <div class="flex flex-col justify-start my-5">
        <h3 class="font-GabaritoMedium text-2xl">Dashboard</h3>
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <i class="fa-solid fa-chart-line me-3"></i>
                        Dashboard
                    </a>
                </li>
            </ol>
        </nav>
    </div>
    <div class="w-full grid grid-cols-3 gap-5">
        <div class="col-span-3">
            <div class="w-1/3 h-48 bg-[#1778BF] flex flex-col items-start justify-between rounded-xl p-5">
                <h3 class="font-GabaritoMedium text-2xl text-white tracking-wider">Total Karyawan</h3>
                <div class="w-full flex justify-between items-end">
                    <h1 class="font-GabaritoRegular font-semibold text-6xl text-white">{{ $countKaryawan }}</h1>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="140" height="140" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-users text-white">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($countStatus as $status => $count)
            <div class="w-full h-48 bg-[#1778BF] flex flex-col items-start justify-between rounded-xl p-5">
                <h3 class="font-GabaritoMedium text-xl text-white tracking-wider">Karyawan {{ $status }}</h3>
                <div class="w-full flex justify-between items-end">
                    <h1 class="font-GabaritoRegular font-semibold text-6xl text-white">{{ $count }}</h1>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="140" height="140" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-users text-white">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                        </svg>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="w-full grid grid-cols-2 gap-5 mt-5">
        <div class="bg-white p-5">
            <div style="width: 500px; height: 500px;">
                <canvas id="genderChart"></canvas>
            </div>
        </div>
        <div class="bg-white p-5">
            <div style="width: 500px; height: 500px;">
                <canvas id="religionChart"></canvas>
            </div>
        </div>
    </div>
    <div class="w-full h-fit bg-white p-5 rounded-xl my-5">
        <div class="flex justify-start items-center">
            <h3 class="font-GabaritoRegular text-2xl">List Karyawan Yang Baru On Boarding</h3>
        </div>
        <table class="table-auto w-full text-sm text-left text-gray-700 border border-gray-300" id="laporan-table">
            <thead class="">
                <tr>
                    <th class="px-4 py-3 font-semibold text-gray-900 border-r border-gray-300">No</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border-r border-gray-300">Nama Karyawan</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border-r ">Email</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border-r">Jabatan </th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border-r">Status</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border-r">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataOnboarding as $i => $a)
                    <tr class="border-t border-gray-300 hover:bg-gray-50 transition">
                        <td class="px-4 py-3 font-medium text-gray-900 border-r border-gray-300">{{ $i + 1 }}
                        </td>
                        <td class="px-4 py-3 text-gray-600 italic border-r border-gray-300">{{ $a->nama_lengkap }}</td>
                        <td class="px-4 py-3 text-gray-600 italic border-r border-gray-300">{{ $a->email_kantor }}</td>
                        <td class="px-4 py-3 text-gray-600 italic border-r border-gray-300">{{ $a->jabatan }}</td>
                        <td class="px-4 py-3 text-gray-600 italic border-r border-gray-300">{{ $a->status_karyawan }}</td>
                        <td class="px-4 py-3 text-gray-600 italic border-r border-gray-300">
                            <a href="{{ route('kepsek.karyawan.detail-onboarding', ['id' => $a->id_karyawan]) }}"
                                class="bg-blue-400 p-1.5 rounded text-white">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="w-full h-fit bg-white rounded-xl p-5 my-5">
        <h3 class="font-GabaritoRegular text-xl">List Karyawan yang Kontraknya akan segera berakhir</h3>
        <div class="my-5">
            @if ($dataOffboarding->count() > 0)
                @foreach ($dataOffboarding as $a)
                    <div class="flex justify-between items-center border border-slate-300 p-3 rounded-lg">
                        <div class="flex justify-start items-center space-x-3">
                            <img src="{{ asset('assets/profile-default-2.jpg') }}" class="rounded-full w-16 h-16 shrink-0"
                                alt="">
                            <div class="flex flex-col justify-center leading-tight space-y-[1px]">
                                <div class="flex items-center space-x-3">
                                    <p class="font-GabaritoSemiBold text-lg leading-tight">{{ $a->nama_lengkap }}</p>
                                    <p class="font-GabaritoRegular text-base text-gray-600">{{ $a->status_karyawan }}</p>
                                </div>
                                <p class="font-GabaritoRegular text-sm leading-tight text-gray-800">{{ $a->jabatan }}</p>
                                <p class="font-GabaritoRegular text-sm leading-tight text-gray-800">
                                    Kontrak tersisa <span class="font-GabaritoMedium text-red-600">{{ $a->sisa_kontrak }}
                                        Hari</span>,
                                    berakhir {{ $a->akhir_kontrak }}
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center space-x-3">
                            <form action="{{ route('kepsek.karyawan.offboarding.perpanjang') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_karyawan" value="{{ $a->id_karyawan }}">
                                <button
                                    class="font-GabaritoRegular text-white px-4 py-1 rounded-full bg-blue-800 text-sm hover:bg-blue-600">Perpanjang</button>
                            </form>
                            <form action="{{ route('kepsek.karyawan.offboarding.pengangkatan') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_karyawan" value="{{ $a->id_karyawan }}">
                                <button
                                    class="font-GabaritoRegular text-white px-4 py-1 rounded-full bg-green-800 text-sm hover:bg-green-600">Pengangkatan</button>
                            </form>
                            <form action="{{ route('kepsek.karyawan.offboarding.pemberhentian') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_karyawan" value="{{ $a->id_karyawan }}">
                                <button
                                    class="font-GabaritoRegular text-white px-4 py-1 rounded-full bg-red-800 text-sm hover:bg-red-600">Lay
                                    Off</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-slate-400 w-full h-full rounded-lg p-5 flex justify-center items-center">
                    <p class="font-GabaritoRegular text-white">Data Kosong !</p>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('content-script')
    <script>
        // Fetch data dari Controller
        fetch('kepsek/getGender')
            .then(response => response.json())
            .then(data => {
                renderGenderChart(data);
            });

        // Fungsi render chart
        function renderGenderChart(genderData) {
            const ctx = document.getElementById('genderChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: [
                        `Perempuan (${genderData.female}%)`,
                        `Laki-laki (${genderData.male}%)`
                    ],
                    datasets: [{
                        data: [genderData.female, genderData.male],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)', // Pink untuk perempuan
                            'rgba(54, 162, 235, 0.7)' // Biru untuk laki-laki
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: `Persentase Gender Karyawan (Total: ${genderData.total})`
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.raw}%`;
                                }
                            }
                        }
                    }
                }
            });
        }
    </script>
    <script>
        // Fetch data agama dari Controller
        fetch('kepsek/getReligion')
            .then(response => response.json())
            .then(data => {
                renderReligionChart(data);
            })
            .catch(error => console.error('Error:', error));

        // Fungsi render chart agama
        function renderReligionChart(religionData) {
            const ctx = document.getElementById('religionChart').getContext('2d');

            // Data untuk chart
            const agamaLabels = [
                `Islam (${religionData.islam}%)`,
                `Kristen (${religionData.kristen}%)`,
                `Katolik (${religionData.katolik}%)`,
                `Hindu (${religionData.hindu}%)`,
                `Buddha (${religionData.buddha}%)`
            ];

            const agamaData = [
                religionData.islam,
                religionData.kristen,
                religionData.katolik,
                religionData.hindu,
                religionData.buddha
            ];

            // Warna untuk setiap agama (sesuaikan jika perlu)
            const agamaColors = [
                'rgba(0, 128, 0, 0.7)', // Hijau untuk Islam
                'rgba(54, 162, 235, 0.7)', // Biru untuk Kristen
                'rgba(255, 99, 132, 0.7)', // Merah muda untuk Katolik
                'rgba(255, 159, 64, 0.7)', // Oranye untuk Hindu
                'rgba(153, 102, 255, 0.7)' // Ungu untuk Buddha
            ];

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: agamaLabels,
                    datasets: [{
                        data: agamaData,
                        backgroundColor: agamaColors,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                padding: 20
                            }
                        },
                        title: {
                            display: true,
                            text: `Persentase Agama Karyawan (Total: ${religionData.total})`,
                            font: {
                                size: 16
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.raw}%`;
                                }
                            }
                        }
                    },
                    // Animasi chart
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });
        }
    </script>
@endsection
