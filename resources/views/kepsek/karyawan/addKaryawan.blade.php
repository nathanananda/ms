@extends('kepsek.layout.layout')

@section('content-user')
    <div class="flex flex-col justify-start">
        <h3 class="font-GabaritoMedium text-2xl">Tambah Karyawan</h3>
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
                        <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Tambah
                            Karyawan</a>
                    </div>
                </li>
            </ol>
        </nav>
    </div>


    <div class="w-full h-fit bg-white rounded-lg my-5 p-5">
        <div class="flex justify-between items-center mb-5">
            <p class="font-GabaritoRegular text-2xl">Data Pribadi</p>
        </div>
        <form action="{{ route('admin.karyawan.store-karyawan') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Data Karyawan -->
            <table class="table-auto w-full text-sm text-left text-gray-700 border border-gray-200">
                <tbody>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300 w-1/3">Nama Lengkap</td>
                        <td class="px-4 py-2">
                            <input type="text" name="nama_lengkap"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan nama lengkap">
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Jenis Kelamin</td>
                        <td class="px-4 py-2">
                            <select name="jenis_kelamin"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih jenis kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Status Aktif</td>
                        <td class="px-4 py-2">
                            <select name="status_aktif"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">No. KTP</td>
                        <td class="px-4 py-2">
                            <input type="text" name="no_ktp"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan nomor KTP">
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Foto</td>
                        <td class="px-4 py-2">
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                                id="file_input" type="file" name="foto">
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">No. HP</td>
                        <td class="px-4 py-2">
                            <input type="text" name="no_hp"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan nomor HP">
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Email Pribadi</td>
                        <td class="px-4 py-2">
                            <input type="email" name="email_pribadi"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan email pribadi">
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Agama</td>
                        <td class="px-4 py-2">
                            <select name="id_agama" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih agama</option>
                                @foreach ($dataAgama as $a)
                                    <option value="{{ $a->id_agama }}">{{ $a->agama }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Status Pernikahan</td>
                        <td class="px-4 py-2">
                            <select name="status_nikah"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih status nikah</option>
                                <option value="Belum Menikah">Belum Menikah</option>
                                <option value="Menikah">Menikah</option>
                                <option value="Cerai">Cerai</option>
                            </select>
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tempat Lahir</td>
                        <td class="px-4 py-2">
                            <input type="text" name="tempat_lahir"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan tempat lahir">
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tanggal Lahir</td>
                        <td class="px-4 py-2">
                            <input type="date" name="tanggal_lahir"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Golongan Darah</td>
                        <td class="px-4 py-2">
                            <select name="golongan_darah"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih golongan darah</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tinggi Badan (cm)</td>
                        <td class="px-4 py-2">
                            <input type="number" name="tinggi_badan"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan tinggi badan">
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Berat Badan (kg)</td>
                        <td class="px-4 py-2">
                            <input type="number" name="berat_badan"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan berat badan">
                        </td>
                    </tr>

                    <tr>
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Kewarganegaraan</td>
                        <td class="px-4 py-2">
                            <select name="kewarganegaraan"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Kewarganegaraan</option>
                                <option value="WNI">WNI</option>
                                <option value="WNA">WNA</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Riwayat Pendidikan -->
            <div class="flex justify-between items-center my-5">
                <p class="font-GabaritoRegular text-2xl">Data Alamat</p>
            </div>
            <table class="table-auto w-full text-sm text-left text-gray-700 border border-gray-200">
                <tbody>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Jenis Alamat
                        </td>
                        <td class="px-4 py-2">
                            <select name="jenis_alamat"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Jenis Alamat</option>
                                <option value="Domisili">Domisili</option>
                                <option value="KTP">KTP</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300 w-1/3">Alamat
                        </td>
                        <td class="px-4 py-2">
                            <textarea name="alamat" rows="3"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Masukkan alamat lengkap"></textarea>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Provinsi
                        </td>
                        <td class="px-4 py-2">
                            @php
                                $provinsi = \App\Models\MasterProvinsi::orderBy('nama_provinsi')->get();
                            @endphp
                            <!-- Provinsi -->
                            <select name="provinsi" id="provinsi"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinsi as $item)
                                    <option value="{{ $item->id_provinsi }}">{{ $item->nama_provinsi }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Kota
                        </td>
                        <td class="px-4 py-2">
                            <select name="kota" id="kota"
                                class="w-full mt-3 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Kota</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Kecamatan
                        </td>
                        <td class="px-4 py-2">
                            <!-- Kecamatan -->
                            <select name="kecamatan" id="kecamatan"
                                class="w-full mt-3 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Kecamatan</option>
                            </select>

                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Kelurahan
                        </td>
                        <td class="px-4 py-2">
                            <!-- Kelurahan -->
                            <select name="id_kelurahan" id="kelurahan"
                                class="w-full mt-3 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Kelurahan</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Kode Pos</td>
                        <td class="px-4 py-2">
                            <input type="text" name="kodepos" id="kode_pos"
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
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300 w-1/3">
                            Tingkat Pendidikan
                        </td>
                        <td class="px-4 py-2">
                            <select name="tingkat_pendidikan"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Tingkat Pendidikan</option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA/SMK</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                            Institusi</td>
                        <td class="px-4 py-2">
                            <input type="text" name="institusi"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                            Jurusan</td>
                        <td class="px-4 py-2">
                            <input type="text" name="jurusan"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                            Tahun
                            Masuk</td>
                        <td class="px-4 py-2">
                            <input type="text" name="tahun_masuk"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                            Tahun
                            Lulus</td>
                        <td class="px-4 py-2">
                            <input type="text" name="tahun_lulus"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                            Gelar
                        </td>
                        <td class="px-4 py-2">
                            <input type="text" name="gelar"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                            Nilai
                        </td>
                        <td class="px-4 py-2">
                            <input type="text" name="nilai"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="flex justify-between items-center my-5">
                <p class="font-GabaritoRegular text-2xl">Kontak Darurat</p>
            </div>
            <table class="table-auto w-full text-sm text-left text-gray-700 border border-gray-200">
                <tbody>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                            Nomor Kontak Darurat</td>
                        <td class="px-4 py-2">
                            <input type="text" name="nomor_kontak_darurat"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                            Nama Kontak Darurat</td>
                        <td class="px-4 py-2">
                            <input type="text" name="nama_kontak_darurat"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                            Hubungan Kontak Darurat
                        </td>
                        <td class="px-4 py-2">
                            <input type="text" name="hubungan_kontak_darurat"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="flex justify-between items-center my-5">
                <p class="font-GabaritoRegular text-2xl">Data Kepegawaian</p>
            </div>
            <table class="table-auto w-full text-sm text-left text-gray-700 border border-gray-200">
                <tbody>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300 w-1/3">NIK Karyawan</td>
                        <td class="px-4 py-2">
                            <input type="text" name="nik_karyawan"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Email Kantor</td>
                        <td class="px-4 py-2">
                            <input type="email" name="email_kantor"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Status Karyawan</td>
                        <td class="px-4 py-2">
                            <select name="id_status_karyawan"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih status</option>
                                @foreach ($dataStatus as $a)
                                    <option value="{{ $a->id_status_karyawan }}">{{ $a->status_karyawan }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Divisi</td>
                        <td class="px-4 py-2">
                            @php
                                $divisis = \App\Models\MasterDivisi::orderBy('nama_divisi')->get();
                            @endphp
                            <select name="divisi" id="divisi"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Divisi</option>
                                @foreach ($divisis as $d)
                                    <option value="{{ $d->id_divisi }}">{{ $d->nama_divisi }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Departemen</td>
                        <td class="px-4 py-2">
                            <!-- Departemen -->
                            <select name="departemen" id="departemen"
                                class="w-full mt-3 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Departemen</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Section</td>
                        <td class="px-4 py-2">
                            <!-- Section -->
                            <select name="id_section" id="section"
                                class="w-full mt-3 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Section</option>
                            </select>

                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Jabatan</td>
                        <td class="px-4 py-2">
                            <select name="id_jabatan"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih jabatan</option>
                                @foreach ($dataJabatan as $j)
                                    <option value="{{ $j->id_jabatan }}">{{ $j->jabatan }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Atasan Langsung</td>
                        <td class="px-4 py-2">
                            <select id="atasan_langsung" name="atasan_langsung"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Atasan Langsung</option>
                                @foreach ($listKaryawan as $karyawan)
                                    <option value="{{ $karyawan->id_karyawan }}">
                                        {{ $karyawan->nik_karyawan }} - {{ $karyawan->nama_lengkap }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Alasan Keluar</td>
                        <td class="px-4 py-2">
                            <textarea name="alasan_keluar" rows="3"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Isi jika karyawan sudah keluar"></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="flex justify-between items-center my-5">
                <p class="font-GabaritoRegular text-2xl">Data Penggajian</p>
            </div>
            <table class="table-auto w-full text-sm text-left text-gray-700 border border-gray-200">
                <tbody>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300 w-1/3">Kode Golongan</td>
                        <td class="px-4 py-2">
                            <select name="kode_golongan"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih golongan</option>
                                <option value="G01">G01 - Golongan I</option>
                                <option value="G02">G02 - Golongan II</option>
                                <option value="G03">G03 - Golongan III</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300 w-1/3">Tunjangan Karyawan
                        </td>
                        <td class="px-4 py-2">
                            <select name="id_jenis_tunjangan"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Pilih Tunjangan</option>
                                @foreach ($dataTunjangan as $a)
                                    <option value="{{ $a->id_jenis_tunjangan }}">{{ $a->jenis_tunjangan }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">NPWP</td>
                        <td class="px-4 py-2">
                            <input type="text" name="npwp"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Nomor NPWP">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">No. Rekening</td>
                        <td class="px-4 py-2">
                            <input type="text" name="no_rekening"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Nomor rekening bank">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">No. BPJS Kesehatan</td>
                        <td class="px-4 py-2">
                            <input type="text" name="no_bpjs_kesehatan"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Nomor BPJS Kesehatan">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">No. BPJS Ketenagakerjaan
                        </td>
                        <td class="px-4 py-2">
                            <input type="text" name="no_bpjs_ketenagakerjaan"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Nomor BPJS Ketenagakerjaan">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">No. BPJS Pensiun</td>
                        <td class="px-4 py-2">
                            <input type="text" name="no_bpjs_pensiun"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Nomor BPJS Pensiun">
                        </td>
                    </tr>
                </tbody>
            </table>



            <div class="flex justify-between items-center my-5">
                <p class="font-GabaritoRegular text-2xl">Data Kontrak Pegawai</p>
            </div>
            <table class="table-auto w-full text-sm text-left text-gray-700 border border-gray-200">
                <tbody>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                            Tanggal Awal Kontrak</td>
                        <td class="px-4 py-2">
                            <input type="date" name="awal_kontrak"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                            Tanggal Akhir Kontrak</td>
                        <td class="px-4 py-2">
                            <input type="date" name="akhir_kontrak"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                            File Kontrak
                        </td>
                        <td class="px-4 py-2">
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                                id="file_input" name="file_kontrak" type="file">
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

@section('content-script')
    <script>
        new TomSelect('#atasan_langsung', {
            placeholder: "Cari atasan langsung...",
        });

        $('#provinsi').on('change', function() {
            let id = $(this).val();
            $('#kota').html('<option value="">Loading...</option>');
            $.get('/get-kota/' + id, function(data) {
                let html = '<option value="">Pilih Kota</option>';
                data.forEach(item => html += `<option value="${item.id_kota}">${item.nama_kota}</option>`);
                $('#kota').html(html);
                $('#kecamatan, #kelurahan').html('<option value="">--</option>');
                $('#kode_pos').val('');
            });
        });

        $('#kota').on('change', function() {
            let id = $(this).val();
            $('#kecamatan').html('<option value="">Loading...</option>');
            $.get('/get-kecamatan/' + id, function(data) {
                let html = '<option value="">Pilih Kecamatan</option>';
                data.forEach(item => html +=
                    `<option value="${item.id_kecamatan}">${item.nama_kecamatan}</option>`);
                $('#kecamatan').html(html);
                $('#kelurahan').html('<option value="">--</option>');
                $('#kode_pos').val('');
            });
        });

        $('#kecamatan').on('change', function() {
            let id = $(this).val();
            $('#kelurahan').html('<option value="">Loading...</option>');
            $.get('/get-kelurahan/' + id, function(data) {
                let html = '<option value="">Pilih Kelurahan</option>';
                data.forEach(item => html +=
                    `<option value="${item.id_kelurahan}" data-kodepos="${item.kodepos}">${item.nama_kelurahan}</option>`
                );
                $('#kelurahan').html(html);
                $('#kode_pos').val('');
            });
        });
    </script>
    <script>
        $('#divisi').on('change', function() {
            let id = $(this).val();
            $('#departemen').html('<option value="">Loading...</option>');
            $.get('/get-departemen/' + id, function(data) {
                let html = '<option value="">Pilih Departemen</option>';
                data.forEach(item => html +=
                    `<option value="${item.id_departemen}">${item.nama_departemen}</option>`);
                $('#departemen').html(html);
                $('#section').html('<option value="">--</option>');
            });
        });

        $('#departemen').on('change', function() {
            let id = $(this).val();
            $('#section').html('<option value="">Loading...</option>');
            $.get('/get-section/' + id, function(data) {
                let html = '<option value="">Pilih Section</option>';
                data.forEach(item => html +=
                    `<option value="${item.id_section}">${item.nama_section}</option>`);
                $('#section').html(html);
            });
        });
    </script>
@endsection
