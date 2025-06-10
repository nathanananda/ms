@extends('kepsek.layout.layout')

@section('content-user')
    <div class="flex flex-col justify-start">
        <h3 class="font-GabaritoMedium text-2xl">Detail Karyawan</h3>
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-replace-user me-3">
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
                        Karyawan
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ route('kepsek.karyawan.onboarding') }}"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">List
                            Karyawan Onboarding</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Detail
                            Karyawan</a>
                    </div>
                </li>
            </ol>
        </nav>
    </div>


    <div class="w-full h-fit bg-white rounded-lg my-5 p-5">
        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200">
            <li class="me-2">
                <button data-target="data-pribadi"
                    class="tab-button inline-block p-4 text-blue-600 bg-gray-100 rounded-t-lg">Data Pribadi</button>
            </li>
            <li class="me-2">
                <button data-target="alamat"
                    class="tab-button inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50">Alamat</button>
            </li>
            <li class="me-2">
                <button data-target="kontak-darurat"
                    class="tab-button inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50">Kontak Darurat
                </button>
            </li>
            <li class="me-2">
                <button data-target="kepegawaian"
                    class="tab-button inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50">Kepegawaian
                </button>
            </li>
            <li class="me-2">
                <button data-target="penggajian"
                    class="tab-button inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50">Penggajian
                </button>
            </li>
            <li class="me-2">
                <button data-target="kontrak"
                    class="tab-button inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50">Kontrak
                </button>
            </li>
            <li class="me-2">
                <button data-target="pendidikan"
                    class="tab-button inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50">Pendidikan
                </button>
            </li>
            <!-- Tambahkan tab lainnya dengan data-target sesuai ID kontennya -->
        </ul>


        <div class="my-5 tab-content" id="data-pribadi">
            <p class="font-GabaritoRegular text-2xl mb-5">Data Pribadi</p>
            <table class="w-full border border-gray-300 text-sm text-left text-gray-500">
                <tbody>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300 w-1/3">Nama Lengkap</td>
                        <td class="px-4 py-2 text-gray-500 italic">{{ $dataPribadi->nama_lengkap }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Jenis Kelamin</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataPribadi->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Status Aktif</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            <span class="{{ $dataPribadi->status_aktif ? 'text-green-600' : 'text-red-600' }}">
                                {{ $dataPribadi->status_aktif ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">No KTP</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataPribadi->no_ktp }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                            No. HP
                        </td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataPribadi->no_hp }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Email Pribadi</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataPribadi->email_pribadi }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                            Agama
                        </td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataPribadi->agama }}

                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                            Status Nikah
                        </td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataPribadi->status_nikah }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tempat, Tanggal Lahir
                        </td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataPribadi->tempat_lahir . ', ' . $dataPribadi->tanggal_lahir }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Golongan Darah</td>
                        <td class="px-4 py-2 text-gray-500 italic">{{ $dataPribadi->golongan_darah }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tinggi Badan</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataPribadi->tinggi_badan }} Cm
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Berat Badan</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataPribadi->berat_badan }} Kg
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Kewarganegaraan</td>
                        <td class="px-4 py-2 text-gray-500 italic">{{ $dataPribadi->kewarganegaraan }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="my-5 hidden tab-content" id="alamat">
            <p class="font-GabaritoRegular text-2xl mb-5">Alamat</p>
            <table class="w-full border border-gray-300 text-sm text-left text-gray-500">
                <tbody>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Status Rumah</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataAlamat->status_rumah }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Jenis Alamat</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataAlamat->jenis_alamat }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Alamat</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataAlamat->alamat }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Provinsi</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataAlamat->nama_provinsi }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Kota</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataAlamat->nama_kota }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Kecamatan</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataAlamat->nama_kecamatan }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Kelurahan</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataAlamat->nama_kelurahan }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Kode Pos</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataAlamat->kodepos }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="my-5 hidden tab-content" id="kontak-darurat">
            <p class="font-GabaritoRegular text-2xl mb-5">Kontak Darurat</p>
            <table class="w-full border border-gray-300 text-sm text-left text-gray-500">
                <tbody>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Nama Kontak</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataKontak->nama_kontak_darurat }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Nomor Kontak</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataKontak->nomor_kontak_darurat }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Hubungan Kontak
                            Darurat
                        </td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataKontak->hubungan_kontak_darurat }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="my-5 hidden tab-content" id="kepegawaian">
            <p class="font-GabaritoRegular text-2xl mb-5">Kepegawaian</p>
            <table class="w-full border border-gray-300 text-sm text-left text-gray-500">
                <tbody>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">NIK Karyawan</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataKepegawaian->nik_karyawan ?? '-' }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Email Kantor</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataKepegawaian->email_kantor ?? '-' }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Status Karyawan</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataKepegawaian->status_karyawan ?? '-' }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Section</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataKepegawaian->nama_section ?? '-' }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Departemen</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataKepegawaian->nama_departemen ?? '-' }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Divisi</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataKepegawaian->nama_divisi ?? '-' }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Jabatan</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataKepegawaian->jabatan ?? '-' }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Atasan Langsung</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataKepegawaian->nama_lengkap ?? '-' }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Alasan Keluar</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataKepegawaian->alasan_keluar ?? '-' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="my-5 hidden tab-content" id="penggajian">
            <p class="font-GabaritoRegular text-2xl mb-5">Penggajian</p>
            <table class="w-full border border-gray-300 text-sm text-left text-gray-500">
                <tbody>
                    <!-- kode_golongan (hanya tampilan) -->
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Kode Golongan</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataPenggajian->kode_golongan ?? '-' }}
                        </td>
                    </tr>

                    <!-- npwp (hanya tampilan) -->
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">NPWP</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataPenggajian->npwp ?? '-' }}
                        </td>
                    </tr>

                    <!-- no_rekening (input) -->
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                            No. Rekening
                        </td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataPenggajian->no_rekening ?? '-' }}
                        </td>
                    </tr>

                    <!-- no_bpjs_kesehatan (input) -->
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                            No. BPJS Kesehatan
                        </td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataPenggajian->no_bpjs_kesehatan ?? '-' }}
                        </td>
                    </tr>

                    <!-- no_bpjs_ketenagakerjaan (input) -->
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                            No. BPJS Ketenagakerjaan
                        </td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataPenggajian->no_bpjs_ketenagakerjaan ?? '-' }}
                        </td>
                    </tr>

                    <!-- no_bpjs_pensiun (input) -->
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                            No. BPJS Pensiun
                        </td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataPenggajian->no_bpjs_pensiun ?? '-' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="my-5 hidden tab-content" id="kontrak">
            <p class="font-GabaritoRegular text-2xl mb-5">Kontrak</p>
            <table class="w-full border border-gray-300 text-sm text-left text-gray-500">
                <tbody>
                    <!-- kode_golongan (hanya tampilan) -->
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tanggal Mulai</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataKontrak->awal_kontrak ?? '-' }}
                        </td>
                    </tr>

                    <!-- npwp (hanya tampilan) -->
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tanggal Berakhir</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            {{ $dataKontrak->akhir_kontrak ?? '-' }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Dokumen Kontrak</td>
                        <td class="px-4 py-2 text-gray-500 italic">
                            @if ($dataKontrak->file_kontrak)
                                <a href="{{ route('show.file_kontrak', ['file' => $dataKontrak->file_kontrak]) }}">
                                    Download Disini
                                </a>
                            @else
                                Tidak ada Lampiran
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="my-5 hidden tab-content" id="pendidikan">
            <div class="flex justify-between items-center my-5">
                <p class="font-GabaritoRegular text-2xl mb-5">Pendidikan</p>
            </div>
            @foreach ($dataPendidikan as $a)
                <table class="w-full border border-gray-300 text-sm text-left text-gray-500">
                    <tbody>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tingkat Pendidikan
                            </td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                {{ $a->tingkat_pendidikan }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Institusi</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                {{ $a->institusi }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Jurusan</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                {{ $a->jurusan }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Gelar</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                {{ $a->gelar }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tahun Masuk</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                {{ $a->tahun_masuk }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tahun Lulus</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                {{ $a->tahun_lulus }}
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Nilai/IPK</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                {{ $a->nilai }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endforeach
        </div>
    </div>
@endsection

@section('content-script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tabButtons = document.querySelectorAll(".tab-button");
            const tabContents = document.querySelectorAll(".tab-content");

            tabButtons.forEach(button => {
                button.addEventListener("click", () => {
                    const targetId = button.getAttribute("data-target");

                    // Ganti tampilan button
                    tabButtons.forEach(btn => {
                        btn.classList.remove("text-blue-600", "bg-gray-100");
                        btn.classList.add("hover:text-gray-600", "hover:bg-gray-50");
                    });
                    button.classList.add("text-blue-600", "bg-gray-100");
                    button.classList.remove("hover:text-gray-600", "hover:bg-gray-50");

                    // Sembunyikan semua tab dan tampilkan hanya yang dipilih
                    tabContents.forEach(content => {
                        if (content.id === targetId) {
                            content.classList.remove("hidden");
                        } else {
                            content.classList.add("hidden");
                        }
                    });
                });
            });
        });
    </script>
@endsection
