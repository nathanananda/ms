<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Management Sekolah - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/preline@latest/dist/preline.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="h-full text-gray-800 font-GabaritoRegular">
    <div class="w-full flex">
        <!-- Sidebar -->
        <aside class="flex flex-col justify-start w-1/5 h-screen bg-white text-black p-4" x-data="{
            openMenu: @if (Str::startsWith(Route::current()->getName(), 'admin.laporan')) 1
            @elseif (Str::startsWith(Route::current()->getName(), 'admin.karyawan') ||
                    Route::current()->getName() === 'admin.offboarding')
                2
            @elseif (Str::startsWith(Route::current()->getName(), 'admin.profile') || Route::current()->getName() === 'admin.finansial')
                3
            @else
                null @endif
        }">
            <div class="flex justify-center">
                <h3 class="text-base font-GabaritoMedium mb-6 text-black">
                    <span class="text-2xl italic">MS,</span>
                    Manajemen Sekolah
                </h3>
            </div>
            <ul class="space-y-2">
                <!-- Menu Utama -->
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="block px-4 py-2 hover:bg-[#232A3E] hover:rounded-2xl hover:text-white  {{ Route::current()->getName() == 'admin.dashboard' ? 'bg-[#232A3E] rounded-2xl text-white' : '' }}">
                        <i class="fa-solid fa-chart-line mr-3"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <button @click="openMenu === 1 ? openMenu = null : openMenu = 1"
                        class="flex items-center justify-between w-full px-4 py-2">

                        <div class="flex items-center space-x-2"> <!-- Ubah jadi flex + space-x -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-text">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                <path
                                    d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                <path d="M9 12h6" />
                                <path d="M9 16h6" />
                            </svg>
                            <span>Laporan Kontrak</span>
                        </div>

                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-90': openMenu === 1 }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <!-- Child Menu -->
                    <ul x-show="openMenu === 1" x-collapse class="ml-16 mt-1 space-y-1 text-sm">
                        <li><a href="{{ route('admin.laporan.perpanjang') }}"
                                class="block text-base px-4 py-2 hover:bg-[#232A3E] hover:rounded-2xl hover:text-white {{ Route::current()->getName() == 'admin.laporan.perpanjang' ? 'bg-[#232A3E] rounded-2xl text-white' : '' }}">Perpanjang</a>
                        </li>
                        <li><a href="{{ route('admin.laporan.pengangkatan') }}"
                                class="block text-base px-4 py-2 hover:bg-[#232A3E] hover:rounded-2xl hover:text-white {{ Route::current()->getName() == 'admin.laporan.pengangkatan' ? 'bg-[#232A3E] rounded-2xl text-white' : '' }}">Pengangkatan</a>
                        </li>
                        <li><a href="{{ route('admin.laporan.pemberhentian') }}"
                                class="block text-base px-4 py-2 hover:bg-[#232A3E] hover:rounded-2xl hover:text-white {{ Route::current()->getName() == 'admin.laporan.pemberhentian' ? 'bg-[#232A3E] rounded-2xl text-white' : '' }}">Pemberhentian</a>
                        </li>
                        <li><a href="{{ route('admin.laporan.persetujuan') }}"
                                class="block text-base px-4 py-2 hover:bg-[#232A3E] hover:rounded-2xl hover:text-white {{ Route::current()->getName() == 'admin.laporan.persetujuan' ? 'bg-[#232A3E] rounded-2xl text-white' : '' }}">Persetujuan</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button @click="openMenu === 2 ? openMenu = null : openMenu = 2"
                        class="flex items-center justify-between w-full px-4 py-2 ">
                        <div class="flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-replace-user">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M21 11v-3c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-6m0 0l3 3m-3 -3l3 -3" />
                                <path
                                    d="M3 13.013v3c0 .53 .211 1.039 .586 1.414c.375 .375 .884 .586 1.414 .586h6m0 0l-3 -3m3 3l-3 3" />
                                <path
                                    d="M16 16.502c0 .53 .211 1.039 .586 1.414c.375 .375 .884 .586 1.414 .586c.53 0 1.039 -.211 1.414 -.586c.375 -.375 .586 -.884 .586 -1.414c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586c-.53 0 -1.039 .211 -1.414 .586c-.375 .375 -.586 .884 -.586 1.414z" />
                                <path
                                    d="M4 4.502c0 .53 .211 1.039 .586 1.414c.375 .375 .884 .586 1.414 .586c.53 0 1.039 -.211 1.414 -.586c.375 -.375 .586 -.884 .586 -1.414c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586c-.53 0 -1.039 .211 -1.414 .586c-.375 .375 -.586 .884 -.586 1.414z" />
                                <path
                                    d="M21 21.499c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-2c-.53 0 -1.039 .211 -1.414 .586c-.375 .375 -.586 .884 -.586 1.414" />
                                <path
                                    d="M9 9.499c0 -.53 -.211 -1.039 -.586 -1.414c-.375 -.375 -.884 -.586 -1.414 -.586h-2c-.53 0 -1.039 .211 -1.414 .586c-.375 .375 -.586 .884 -.586 1.414" />
                            </svg>
                            <span>Karyawan</span>
                        </div>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-90': openMenu === 2 }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <!-- Child Menu -->
                    <ul x-show="openMenu === 2" x-collapse class="ml-16 mt-1 space-y-1 text-sm">
                        <li><a href="{{ route('admin.karyawan.list', ['status' => 'all']) }}"
                                class="block text-base px-4 py-2 hover:bg-[#232A3E] hover:rounded-2xl hover:text-white {{ Route::current()->getName() == 'admin.karyawan.list' ? 'bg-[#232A3E] rounded-2xl text-white' : '' }}">List
                                Karyawan</a>
                        </li>
                        <li><a href="{{ route('admin.karyawan.onboarding') }}"
                                class="block text-base px-4 py-2 hover:bg-[#232A3E] hover:rounded-2xl hover:text-white {{ Route::current()->getName() == 'admin.karyawan.onboarding' ? 'bg-[#232A3E] rounded-2xl text-white' : '' }}">List
                                On
                                Boarding</a>
                        </li>
                        <li><a href="{{ route('admin.offboarding') }}"
                                class="block text-base px-4 py-2 hover:bg-[#232A3E] hover:rounded-2xl hover:text-white {{ Route::current()->getName() == 'admin.offboarding' ? 'bg-[#232A3E] rounded-2xl text-white' : '' }}">List
                                Off
                                Boarding</a>
                        </li>
                        <li><a href="{{ route('admin.karyawan.tambah-karyawan') }}"
                                class="block text-base px-4 py-2 hover:bg-[#232A3E] hover:rounded-2xl hover:text-white {{ Route::current()->getName() == 'admin.karyawan.tambah-karyawan' ? 'bg-[#232A3E] rounded-2xl text-white' : '' }}">Tambah
                                Karyawan</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button @click="openMenu === 3 ? openMenu = null : openMenu = 3"
                        class="flex items-center justify-between w-full px-4 py-2 ">
                        <div class="flex items-center space-x-2">
                            <i class="fa-solid fa-user"></i>
                            <span>Profile</span>
                        </div>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-90': openMenu === 3 }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <!-- Child Menu -->
                    <ul x-show="openMenu === 3" x-collapse class="ml-16 mt-1 space-y-1 text-sm">
                        <li><a href="{{ route('admin.profile') }}"
                                class="block text-base px-4 py-2 hover:bg-[#232A3E] hover:rounded-2xl hover:text-white {{ Route::current()->getName() == 'admin.profile' ? 'bg-[#232A3E] rounded-2xl text-white' : '' }}">Overview</a>
                        </li>
                        <li><a href="{{ route('admin.finansial') }}"
                                class="block text-base px-4 py-2 hover:bg-[#232A3E] hover:rounded-2xl hover:text-white {{ Route::current()->getName() == 'admin.finansial' ? 'bg-[#232A3E] rounded-2xl text-white' : '' }}">Finansial</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                        class="block px-4 py-2 hover:bg-[#232A3E] hover:rounded-2xl hover:text-white">
                        <i class="fa-solid fa-arrow-right-from-bracket mr-3"></i>
                        Logout
                    </a>
                </li>

            </ul>
        </aside>
        <div class="w-4/5 bg-gray-100 p-5" style="background-image: url('{{ asset('assets/bg-layout.svg') }}');">
            <div class="flex justify-end items-center space-x-2 relative" x-data="{ open: false }">
                <!-- Notifikasi -->
                <a href="{{ route('admin.notification') }}">
                    <i class="fa-solid fa-bell text-lg"></i>
                </a>

                @php
                    $nama = session('name') ?? 'User';
                    $parts = explode(' ', trim($nama));
                    $count = count($parts);
                    $initials = '';

                    if ($count >= 2) {
                        // Ambil huruf pertama dari 2 kata terakhir
                        $initials = strtoupper(substr($parts[$count - 2], 0, 1) . substr($parts[$count - 1], 0, 1));
                    } else {
                        // Kalau hanya 1 kata, ambil 2 huruf pertama
                        $initials = strtoupper(substr($parts[0], 0, 2));
                    }
                @endphp

                <!-- Trigger Dropdown -->
                <div @click="open = !open" class="flex items-center space-x-2 cursor-pointer">
                    <div class="relative">
                        <div
                            class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-sm font-bold text-white">
                            {{ $initials }}
                        </div>
                    </div>
                    <div class="text-sm font-GabaritoRegular">
                        <p>{{ Auth::user()->role }}</p>
                        <p>{{ session('name') }}</p>
                    </div>
                </div>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.outside="open = false" x-transition
                    class="absolute top-full right-0 mt-2 w-48 bg-[#232A3E] text-white border border-gray-300 rounded-lg shadow-lg z-50">
                    <a href="{{ route('admin.profile') }}" class="block px-4 py-2 hover:text-blue-400">
                        <i class="fa-solid fa-user text-sm me-3"></i>
                        Profile
                    </a>
                    <a href="{{ route('admin.change-pass') }}" class="block px-4 py-2 hover:text-blue-400">
                        <i class="fa-solid fa-lock text-sm me-3"></i>
                        Reset password
                    </a>
                    <a href="{{ route('logout') }}" class="block px-4 py-2 hover:text-blue-400">
                        <i class="fa-solid fa-arrow-right-from-bracket mr-3"></i>
                        Logout
                    </a>
                </div>
            </div>

            @yield('content-user')
            <footer class="flex flex-col justify-center items-center mt-5">
                <p class="font-GabaritoRegular text-sm">Developed by Us</p>
                <p class="font-GabaritoRegular text-sm">Copyright &copy; 2025 MS, Manajemen Sekolah</p>
            </footer>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- jQuery + DataTables JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @include('sweetalert::alert')
    @yield('content-script')

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle icon
            if (type === 'text') {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    </script>

</body>

</html>
