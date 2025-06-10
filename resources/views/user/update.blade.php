@extends('user.layout.layout')

@section('content-user')
    <div class="flex flex-col justify-start">
        <h3 class="font-GabaritoMedium text-2xl">Edit Data Karyawan</h3>
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <i class="fa-solid fa-user me-3"></i>
                        Profile
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ route('user.profile') }}"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Overview</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Edit
                            Data Karyawan</a>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="w-full h-fit bg-white rounded-lg my-5 p-5">
        <div class="flex justify-between items-center mb-5">
            <p class="font-GabaritoRegular text-2xl">Data Pribadi</p>
        </div>
        <form action="">
            <!-- Data Karyawan -->
            <table class="table-auto w-full text-sm text-left text-gray-700 border border-gray-200">
                <tbody>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300 w-1/3">Nama Karyawan</td>
                        <td class="px-4 py-2">
                            <input type="text" name="nama_karyawan"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan nama karyawan">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Nomor Induk Karyawan</td>
                        <td class="px-4 py-2">
                            <input type="text" name="nik"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan NIK">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">No Telp</td>
                        <td class="px-4 py-2">
                            <input type="text" name="no_telp"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan No Telepon">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tempat, Tanggal Lahir</td>
                        <td class="px-4 py-2">
                            <input type="text" name="ttl"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Contoh: Bandung, 1 Januari 2000">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Alamat</td>
                        <td class="px-4 py-2">
                            <textarea name="alamat" rows="3"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan alamat lengkap"></textarea>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">RT</td>
                        <td class="px-4 py-2">
                            <input type="text" name="rt"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">RW</td>
                        <td class="px-4 py-2">
                            <input type="text" name="rw"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Riwayat Pendidikan -->
            <div class="flex justify-between items-center my-5">
                <p class="font-GabaritoRegular text-2xl">Riwayat Pendidikan</p>
            </div>
            <table class="table-auto w-full text-sm text-left text-gray-700 border border-gray-200">
                <tbody>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300 w-1/3">Jenjang Pendidikan
                        </td>
                        <td class="px-4 py-2">
                            <select name="jenjang"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih jenjang</option>
                                <option value="sd">SD</option>
                                <option value="smp">SMP</option>
                                <option value="sma">SMA/SMK</option>
                                <option value="s1">S1</option>
                                <option value="s2">S2</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Nama Sekolah / Universitas
                        </td>
                        <td class="px-4 py-2">
                            <input type="text" name="nama_sekolah"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tahun Lulus</td>
                        <td class="px-4 py-2">
                            <input type="text" name="tahun_lulus"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Tombol Submit -->
            <div class="flex justify-end items-center my-5">
                <button type="submit"
                    class="font-GabaritoRegular text-white px-4 py-2 rounded-lg text-sm bg-[#557EF8] hover:bg-blue-700 transition duration-200">
                    Simpan
                    <i class="fa-solid fa-floppy-disk text-white ms-2"></i>
                </button>
            </div>
        </form>

    </div>
@endsection
