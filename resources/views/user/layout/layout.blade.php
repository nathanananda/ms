<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Management Sekolah - User</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/preline@latest/dist/preline.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-white text-gray-800 font-GabaritoRegular h-screen">
    <div class="w-full min-h-screen flex">
        <!-- Sidebar -->
        <aside class="flex flex-col justify-start w-1/5 h-screen bg-white text-black p-4" x-data="{
            openMenu: @json(in_array(Route::currentRouteName(), ['user.profile', 'user.finansial']) ? 1 : null)
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
                    <button @click="openMenu === 1 ? openMenu = null : openMenu = 1"
                        class="flex items-center justify-between w-full px-4 py-2">
                        <div class="space-x-2">
                            <i class="fa-solid fa-user"></i>
                            <span>Profile</span>
                        </div>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-90': openMenu === 1 }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Child Menu -->
                    <ul x-show="openMenu === 1" x-collapse class="ml-16 mt-1 space-y-1 text-sm">
                        <li>
                            <a href="{{ route('user.profile') }}"
                                class="block text-base px-4 py-2 hover:bg-[#232A3E] hover:rounded-2xl hover:text-white {{ Route::currentRouteName() == 'user.profile' ? 'bg-[#232A3E] rounded-2xl text-white' : '' }}">
                                Overview
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user.finansial') }}"
                                class="block text-base px-4 py-2 hover:bg-[#232A3E] hover:rounded-2xl hover:text-white {{ Route::currentRouteName() == 'user.finansial' ? 'bg-[#232A3E] rounded-2xl text-white' : '' }}">
                                Finansial
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Logout -->
                <li>
                    <a href="{{ route('logout') }}"
                        class="block px-4 py-2 hover:bg-[#232A3E] hover:rounded-2xl hover:text-white">
                        <i class="fa-solid fa-arrow-right-from-bracket mr-3"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </aside>

        <div class="w-4/5 min-h-screen bg-gray-100 p-5"
            style="background-image: url('{{ asset('assets/bg-layout.svg') }}">
            <div class="flex justify-end items-center space-x-2 relative" x-data="{ open: false }">
                <!-- Notifikasi -->
                <a href="{{ route('user.notification') }}">
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
                        <p>{{ $dataPribadi->nama_lengkap }}</p>
                    </div>
                </div>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.outside="open = false" x-transition
                    class="absolute top-full right-0 mt-2 w-48 bg-[#232A3E] text-white border border-gray-300 rounded-lg shadow-lg z-50">
                    <a href="{{ route('user.profile') }}" class="block px-4 py-2 hover:text-blue-400">
                        <i class="fa-solid fa-user text-sm me-3"></i>
                        Profile
                    </a>
                    <a href="{{ route('user.change-pass') }}" class="block px-4 py-2 hover:text-blue-400">
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @include('sweetalert::alert')

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
    @yield('content-script')

</body>

</html>
