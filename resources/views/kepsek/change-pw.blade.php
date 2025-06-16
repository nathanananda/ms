<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Klinik Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/preline@latest/dist/preline.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-white text-gray-800 font-GabaritoRegular h-screen overflow-hidden">
    <div class="flex w-full h-screen">
        <!-- Kiri: Form Login -->
        <div class="w-full md:w-1/2 flex justify-center items-center px-10">
            <form action="{{ route('kepsek.change-pass.store') }}" method="POST" class="w-full max-w-md">
                @csrf
                <h3 class="text-base font-GabaritoMedium mb-6 text-black">
                    <span class="text-2xl italic">MS,</span>
                    Manajemen Siswa
                </h3>

                <div class="flex flex-col space-y-0 mb-3">
                    <h3 class="font-GabaritoMedium text-2xl">Ganti Kata Sandi</h3>
                    <p class="font-GabaritoRegular text-sm">Silahkan mengganti kata sandi Anda dengan kombinasi huruf,
                        angka, dan simbol</p>
                </div>

                <div class="mb-4">
                    <label for="old_password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi
                        Lama</label>
                    <div class="relative">
                        <input type="password" name="old_password" id="old_password" required
                            class="block w-full border border-gray-300 rounded-md shadow-sm p-2 pr-10 focus:ring-blue-500 focus:border-blue-500" />

                        <button type="button" id="toggleOldPassword"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-600">
                            <i class="fa-solid fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi
                        Baru</label>
                    <div class="relative">
                        <input type="password" name="new_password" id="new_password" required
                            class="block w-full border border-gray-300 rounded-md shadow-sm p-2 pr-10 focus:ring-blue-500 focus:border-blue-500" />

                        <button type="button" id="toggleNewPassword"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-600">
                            <i class="fa-solid fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="confirm_new_password" class="block text-sm font-medium text-gray-700 mb-1">Ketik Ulang
                        Kata Sandi Baru</label>
                    <div class="relative">
                        <input type="password" name="confirm_new_password" id="confirm_new_password" required
                            class="block w-full border border-gray-300 rounded-md shadow-sm p-2 pr-10 focus:ring-blue-500 focus:border-blue-500" />

                        <button type="button" id="toggleConfirmPassword"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-600">
                            <i class="fa-solid fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="w-full flex space-x-5">

                    <a href="{{ route('kepsek.profile') }}"
                        class="flex w-full justify-center items-center py-2 px-4 bg-red-600 text-white rounded-md hover:bg-red-700">
                        <i class="fa-solid fa-right-from-bracket me-3"></i>
                        Kembali
                    </a>
                    <button type="submit"
                        class="flex w-full justify-center items-center py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Ganti Kata Sandi
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="currentColor"
                            class="icon icon-tabler icons-tabler-filled icon-tabler-lock text-white ms-3 ">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M12 2a5 5 0 0 1 5 5v3a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-10a3 3 0 0 1 -3 -3v-6a3 3 0 0 1 3 -3v-3a5 5 0 0 1 5 -5m0 12a2 2 0 0 0 -1.995 1.85l-.005 .15a2 2 0 1 0 2 -2m0 -10a3 3 0 0 0 -3 3v3h6v-3a3 3 0 0 0 -3 -3" />
                        </svg>
                    </button>
                </div>

            </form>
        </div>

        <!-- Kanan: Gambar -->
        <div class="hidden md:block w-1/2 h-screen">
            <img src="{{ asset('assets/image-login.png') }}" alt="Image" class="w-full h-full object-cover" />
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
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
        // Toggle Old Password
        const toggleOldPassword = document.getElementById('toggleOldPassword');
        const oldPasswordInput = document.getElementById('old_password');
        const oldEyeIcon = toggleOldPassword.querySelector('i');

        toggleOldPassword.addEventListener('click', function() {
            const type = oldPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            oldPasswordInput.setAttribute('type', type);

            oldEyeIcon.classList.toggle('fa-eye');
            oldEyeIcon.classList.toggle('fa-eye-slash');
        });

        // Toggle New Password
        const toggleNewPassword = document.getElementById('toggleNewPassword');
        const newPasswordInput = document.getElementById('new_password');
        const newEyeIcon = toggleNewPassword.querySelector('i');

        toggleNewPassword.addEventListener('click', function() {
            const type = newPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            newPasswordInput.setAttribute('type', type);

            newEyeIcon.classList.toggle('fa-eye');
            newEyeIcon.classList.toggle('fa-eye-slash');
        });

        // Toggle Confirm New Password
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordInput = document.getElementById('confirm_new_password');
        const confirmEyeIcon = toggleConfirmPassword.querySelector('i');

        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);

            confirmEyeIcon.classList.toggle('fa-eye');
            confirmEyeIcon.classList.toggle('fa-eye-slash');
        });
    </script>


</body>

</html>
