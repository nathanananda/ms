@extends('kepsek.layout.layout')

@section('content-user')
    <div class="flex flex-col justify-start my-5">
        <h3 class="font-GabaritoMedium text-2xl">Perpanjang Kontrak</h3>
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <i class="fa-solid fa-chart-line me-3"></i>
                        Laporan Kontrak
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ route('kepsek.laporan.persetujuan') }}"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Persetujuan</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href=""
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Perpanjang</a>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <div class="w-full min-h-screen bg-white rounded-xl p-5">
        <h3 class="font-GabaritoRegular text-2xl">Perpanjang Kontrak</h3>

        <div class="flex justify-between items-start my-5 space-x-3">
            <div class="w-1/2">
                <div class="mb-4">
                    <label for="nik" class="block text-sm font-medium text-gray-700">NIK Karyawan</label>
                    <input type="text" name="nik" id="nik" value="{{ $dataKaryawan->nik_karyawan }}" disabled
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Karyawan</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ $dataKaryawan->nama_lengkap }}"
                        disabled
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="awal_kontrak" class="block text-sm font-medium text-gray-700">Tanggal Mulai
                        Kontrak</label>
                    <input type="date" name="awal_kontrak" id="awal_kontrak" value="{{ $dataKaryawan->awal_kontrak }}"
                        required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="akhir_kontrak" class="block text-sm font-medium text-gray-700">Tanggal Berakhir
                        Kontrak</label>
                    <input type="date" name="akhir_kontrak" id="akhir_kontrak" value="{{ $dataKaryawan->akhir_kontrak }}"
                        required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                    <input type="text" name="jabatan" id="jabatan" value="{{ $dataKaryawan->jabatan }}" disabled
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="status_karyawan" class="block text-sm font-medium text-gray-700">Status Karyawan</label>
                    <input type="text" name="status_karyawan" id="status_karyawan"
                        value="{{ $dataKaryawan->status_karyawan }}" disabled
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <div class="w-1/2">
                @if ($dataKaryawan->file_kontrak != null)
                    <label for="upload_kontrak" class="block text-sm font-medium text-gray-700 mb-2">
                        Download Dokumen Perpanjang Kontrak
                    </label>
                    <a href="{{ route('show.file_kontrak', ['file' => $dataKaryawan->file_kontrak]) }}" target="_blank">
                        <label for="upload_kontrak"
                            class="w-full h-44 flex justify-center items-center border border-slate-200 rounded-lg p-5 cursor-pointer hover:bg-gray-50 transition relative">
                            <div class="flex flex-col justify-center items-center pointer-events-none" id="upload_area">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                    <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                                    <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                                    <path d="M17 18h2" />
                                    <path d="M20 15h-3v6" />
                                    <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
                                </svg>
                                <p class="font-GabaritoRegular text-sm mt-2" id="file-name">
                                    {{ $dataKaryawan->file_kontrak }}</p>
                            </div>
                        </label>
                    </a>
                @endif
            </div>
        </div>
        <div class="flex justify-end items-center space-x-5">
            <form action="{{ route('kepsek.laporan.persetujuan.approve-kontrak') }}" method="POST">
                @csrf
                <input type="hidden" name="id_karyawan" value="{{ $dataKaryawan->id_karyawan }}">
                <input type="hidden" name="id_kontrak" value="{{ $dataKaryawan->id_kontrak }}">
                <button class="font-GabaritoRegular text-white bg-green-500 px-5 py-1 rounded">
                    Approve
                </button>
            </form>
        </div>
    </div>
@endsection

@section('content-script')
    <script>
        const input = document.getElementById('upload_kontrak');
        const fileNameDisplay = document.getElementById('file-name');

        input.addEventListener('change', function() {
            if (input.files.length > 0) {
                fileNameDisplay.textContent = input.files[0].name;
            } else {
                fileNameDisplay.textContent = 'Tekan di sini untuk upload file!';
            }
        });
    </script>
@endsection
