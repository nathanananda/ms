@extends('admin.layout.layout')

@section('content-user')
    <div class="flex flex-col justify-start">
        <h3 class="font-GabaritoMedium text-2xl">Update Karyawan</h3>
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
                        <a href="{{ route('admin.karyawan.list', ['status' => 'all']) }}"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">List
                            Karyawan</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Update
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
            <form action="{{ route('admin.detail.karyawan.updateProfile') }}" method="POST">
                @csrf
                <input type="hidden" name="id_karyawan" value="{{ $dataPribadi->id_karyawan }}">
                <table class="w-full border border-gray-300 text-sm text-left text-gray-500">
                    <tbody>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300 w-1/3">Nama Lengkap</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="text" name="nama_lengkap" value="{{ $dataPribadi->nama_lengkap }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Jenis Kelamin</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <select name="jenis_kelamin"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih Gender</option>
                                    <option value="L" {{ $dataPribadi->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                        Laki-laki
                                    </option>
                                    <option value="P" {{ $dataPribadi->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Status Aktif</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <select name="status_aktif"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih Status</option>
                                    <option value="1" {{ $dataPribadi->status_aktif == 1 ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="0" {{ $dataPribadi->status_aktif == 0 ? 'selected' : '' }}>Tidak
                                        Aktif
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">No KTP</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="text" name="no_ktp" value="{{ $dataPribadi->no_ktp }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                No. HP
                            </td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="text" name="no_hp" value="{{ $dataPribadi->no_hp }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Email Pribadi</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="email" name="email_pribadi" value="{{ $dataPribadi->email_pribadi }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                Agama
                            </td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <select name="id_agama"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih agama</option>
                                    @foreach ($MasterAgama as $key)
                                        <option value="{{ $key->id_agama }}"
                                            {{ $dataPribadi->id_agama == $key->id_agama ? 'selected' : '' }}>
                                            {{ $key->agama }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                Status Nikah
                            </td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <select name="status_nikah"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih agama</option>
                                    <option value="Menikah" {{ $dataPribadi->status_nikah == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                    <option value="Belum Menikah" {{ $dataPribadi->status_nikah == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                    <option value="Cerai" {{ $dataPribadi->status_nikah == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tempat Lahir
                            </td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="text" name="tempat_lahir" value="{{ $dataPribadi->tempat_lahir }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tanggal Lahir
                            </td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="date" name="tanggal_lahir" value="{{ $dataPribadi->tanggal_lahir }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Golongan Darah</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <select name="golongan_darah"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih golongan darah</option>
                                    <option value="A" {{ $dataPribadi->golongan_darah == 'A' ? 'selected' : '' }}>A
                                    </option>
                                    <option value="B" {{ $dataPribadi->golongan_darah == 'B' ? 'selected' : '' }}>B
                                    </option>
                                    <option value="AB" {{ $dataPribadi->golongan_darah == 'AB' ? 'selected' : '' }}>AB
                                    </option>
                                    <option value="O" {{ $dataPribadi->golongan_darah == 'O' ? 'selected' : '' }}>O
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tinggi Badan</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="text" name="tinggi_badan" value="{{ $dataPribadi->tinggi_badan }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Berat Badan</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="text" name="berat_badan" value="{{ $dataPribadi->berat_badan }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Kewarganegaraan</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <select name="kewarganegaraan"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih Kewarganegaraan</option>
                                    <option value="WNI" {{ $dataPribadi->kewarganegaraan == 'WNI' ? 'selected' : '' }}>
                                        WNI</option>
                                    <option value="WNA" {{ $dataPribadi->kewarganegaraan == 'WNA' ? 'selected' : '' }}>
                                        WNA</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-end items-center my-5">
                    <button class="bg-blue-500 text-white py-2 px-4 rounded">Update</button>
                </div>
            </form>
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
            <form action="{{ route('admin.detail.karyawan.updateKontak') }}" method="POST">
                @csrf
                <input type="hidden" name="id_karyawan" value="{{ $dataKontak->id_karyawan }}">
                <table class="w-full border border-gray-300 text-sm text-left text-gray-500">
                    <tbody>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Nama Kontak</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="text" name="nama_kontak_darurat"
                                    value="{{ $dataKontak->nama_kontak_darurat }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Nomor Kontak</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="text" name="nomor_kontak_darurat"
                                    value="{{ $dataKontak->nomor_kontak_darurat }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Hubungan Kontak
                                Darurat
                            </td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="text" name="hubungan_kontak_darurat"
                                    value="{{ $dataKontak->hubungan_kontak_darurat }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-end items-center my-5">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
        <div class="my-5 hidden tab-content" id="kepegawaian">
            <p class="font-GabaritoRegular text-2xl mb-5">Kepegawaian</p>
            <form action="{{ route('admin.detail.karyawan.updateKepegawaian') }}" method="POST">
                @csrf
                <input type="hidden" name="id_karyawan" value="{{ $dataPribadi->id_karyawan }}">
                <table class="w-full border border-gray-300 text-sm text-left text-gray-500">
                    <tbody>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">NIK Karyawan</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="text" name="nik_karyawan" value="{{ $dataKepegawaian->nik_karyawan }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Email Kantor</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="text" name="email_kantor" value="{{ $dataKepegawaian->email_kantor }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Status Karyawan</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <select name="id_status_karyawan" required
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih Status Karyawan</option>
                                    @foreach ($masterStatus as $s)
                                        <option value="{{ $s->id_status_karyawan }}"
                                            {{ $s->id_status_karyawan == $dataKepegawaian->id_status_karyawan ? 'selected' : '' }}>
                                            {{ $s->status_karyawan }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Section</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <select name="id_section" required
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih Section</option>
                                    @foreach ($masterSection as $a)
                                        <option value="{{ $a->id_section }}"
                                            {{ $a->id_section == $dataKepegawaian->id_section ? 'selected' : '' }}">
                                            {{ $a->nama_section }} - {{ $a->id_section }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Jabatan</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <select name="id_jabatan" required
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih Jabatan</option>
                                    @foreach ($masterJabatan as $a)
                                        <option value="{{ $a->id_jabatan }}"
                                            {{ $a->id_jabatan == $dataKepegawaian->id_jabatan ? 'selected' : '' }}">
                                            {{ $a->jabatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Alasan Keluar</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="text" name="alasan_keluar" value="{{ $dataKepegawaian->alasan_keluar }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-end items-center my-5">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                        SImpan
                    </button>
                </div>
            </form>
        </div>
        <div class="my-5 hidden tab-content" id="penggajian">
            <p class="font-GabaritoRegular text-2xl mb-5">Penggajian</p>
            <form action="{{ route('admin.detail.karyawan.updatePenggajian') }}" method="POST">
                @csrf
                <input type="hidden" name="id_karyawan" value="{{ $dataPribadi->id_karyawan }}">
                <table class="w-full border border-gray-300 text-sm text-left text-gray-500">
                    <tbody>
                        <!-- kode_golongan (hanya tampilan) -->
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Kode Golongan</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <select name="kode_golongan"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih golongan</option>
                                    <option value="G01" {{ $dataPenggajian->kode_golongan == 'G01' ? 'selected' : '' }}>G01 - Golongan I</option>
                                    <option value="G02" {{ $dataPenggajian->kode_golongan == 'G02' ? 'selected' : '' }}>G02 - Golongan II</option>
                                    <option value="G03" {{ $dataPenggajian->kode_golongan == 'G03' ? 'selected' : '' }}>G03 - Golongan III</option>
                                </select>
                            </td>
                        </tr>

                        <!-- npwp (hanya tampilan) -->
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">NPWP</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="text" name="npwp" value="{{ $dataPenggajian->npwp ?? '' }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-500 italic">
                            </td>
                        </tr>

                        <!-- no_rekening (input) -->
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">No. Rekening</td>
                            <td class="px-4 py-2">
                                <input type="text" name="no_rekening" value="{{ $dataPenggajian->no_rekening ?? '' }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-500 italic">
                            </td>
                        </tr>

                        <!-- no_bpjs_kesehatan (input) -->
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">No. BPJS Kesehatan</td>
                            <td class="px-4 py-2">
                                <input type="text" name="no_bpjs_kesehatan"
                                    value="{{ $dataPenggajian->no_bpjs_kesehatan ?? '' }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-500 italic">
                            </td>
                        </tr>

                        <!-- no_bpjs_ketenagakerjaan (input) -->
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">No. BPJS Ketenagakerjaan
                            </td>
                            <td class="px-4 py-2">
                                <input type="text" name="no_bpjs_ketenagakerjaan"
                                    value="{{ $dataPenggajian->no_bpjs_ketenagakerjaan ?? '' }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-500 italic">
                            </td>
                        </tr>

                        <!-- no_bpjs_pensiun (input) -->
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">No. BPJS Pensiun</td>
                            <td class="px-4 py-2">
                                <input type="text" name="no_bpjs_pensiun"
                                    value="{{ $dataPenggajian->no_bpjs_pensiun ?? '' }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-500 italic">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-end items-center">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Simpan
                    </button>
                </div>
            </form>
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
                <!-- Modal toggle -->
                <button data-modal-target="create-modal" data-modal-toggle="create-modal"
                    class="font-GabaritoRegular text-white px-4 py-2 rounded-lg text-sm bg-[#557EF8] hover:bg-blue-700 transition duration-200"
                    type="button">
                    Add Pendidikan
                </button>

                <!-- Main modal -->
                <div id="create-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow-sm">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t  border-gray-200">
                                <h3 class="text-xl font-semibold text-gray-900">
                                    Update Data Pendidikan
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    data-modal-hide="create-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5">
                                <form action="{{ route('admin.detail.karyawan.add-pendidikan') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_karyawan" value="{{ $dataPribadi->id_karyawan }}">
                                    <table
                                        class="table-auto w-full text-sm text-left text-gray-700 border border-gray-200">
                                        <tbody>
                                            <tr class="border-b">
                                                <td
                                                    class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300 w-1/3">
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
                                    <div class="flex justify-end items-center my-5">
                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                            Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($dataPendidikan as $a)
                <form action="{{ route('admin.detail.karyawan.update-pendidikan') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_riwayat_pendidikan" value="{{ $a->id_riwayat_pendidikan }}">
                    <input type="hidden" name="id_karyawan" value="{{ $a->id_karyawan }}">
                    <table class="w-full border border-gray-300 text-sm text-left text-gray-500 my-5">
                        <tbody>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tingkat Pendidikan
                                </td>
                                <td class="px-4 py-2">
                                    <select name="tingkat_pendidikan" required
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Pilih Section</option>
                                        <option value="TK" {{ $a->tingkat_pendidikan == 'TK' ? 'selected' : '' }}>TK
                                        </option>
                                        <option value="SD" {{ $a->tingkat_pendidikan == 'SD' ? 'selected' : '' }}>SD
                                        </option>
                                        <option value="SMP" {{ $a->tingkat_pendidikan == 'SMP' ? 'selected' : '' }}>SMP
                                        </option>
                                        <option value="SMA" {{ $a->tingkat_pendidikan == 'SMA' ? 'selected' : '' }}>SMA
                                        </option>
                                        <option value="S1" {{ $a->tingkat_pendidikan == 'S1' ? 'selected' : '' }}>S1
                                        </option>
                                        <option value="S2" {{ $a->tingkat_pendidikan == 'S2' ? 'selected' : '' }}>S2
                                        </option>
                                        <option value="S3" {{ $a->tingkat_pendidikan == 'S3' ? 'selected' : '' }}>S3
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Institusi</td>
                                <td class="px-4 py-2">
                                    <input type="text" name="institusi" value="{{ $a->institusi }}"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-500 italic">
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Jurusan</td>
                                <td class="px-4 py-2">
                                    <input type="text" name="jurusan" value="{{ $a->jurusan }}"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-500 italic">
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Gelar</td>
                                <td class="px-4 py-2">
                                    <input type="text" name="gelar" value="{{ $a->gelar }}"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-500 italic">
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tahun Masuk</td>
                                <td class="px-4 py-2">
                                    <input type="text" name="tahun_masuk" value="{{ $a->tahun_masuk }}"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-500 italic">
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tahun Lulus</td>
                                <td class="px-4 py-2">
                                    <input type="text" name="tahun_lulus" value="{{ $a->tahun_lulus }}"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-500 italic">
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Nilai/IPK</td>
                                <td class="px-4 py-2">
                                    <input type="text" name="nilai" value="{{ $a->nilai }}"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-500 italic">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex justify-between items-center my-5">
                        <a href="{{ route('admin.detail.karyawan.delete-pendidikan', ['id' => $a->id_riwayat_pendidikan]) }}"
                            class="font-GabaritoRegular text-sm text-white bg-red-500 p-2 rounded">
                            Delete
                        </a>
                        <button type="submit" class="font-GabaritoRegular text-sm text-white bg-[#557EF8] p-2 rounded">
                            Update
                        </button>
                    </div>
                </form>
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
