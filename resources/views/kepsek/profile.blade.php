@extends('kepsek.layout.layout')

@section('content-user')
    <div class="flex flex-col justify-start">
        <h3 class="font-GabaritoMedium text-2xl">Profile</h3>
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
                        <a href="#"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Overview</a>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="w-full h-fit bg-white rounded-lg my-5 p-5">
        <div class="flex justify-start items-center space-x-5">
            <h3 class="font-GabaritoRegular text-2xl">{{ $dataPribadi->nama_lengkap }}</h3>
            <span class="font-GabaritoRegular bg-[#F8901F] text-white px-3 rounded-xl">
                {{ $dataPribadi->status_karyawan }}
            </span>
        </div>
        <p class="font-GabaritoRegular text-base">{{ $dataPribadi->nik_karyawan }}</p>
        <div class="w-1/4 h-fit bg-[#232A3E] rounded-2xl p-5">
            <div class="flex flex-col justify-center items-center space-y-3">
                <p class="font-GabaritoRegular text-xl text-white tracking-wider">{{ $dataPribadi->status_karyawan }} -
                    {{ $dataPribadi->jabatan }}</p>
                <p class="font-GabaritoRegular text-sm text-white">Berlaku Hingga</p>
                <p class="font-GabaritoRegular text-2xl text-white">31 Desember 2023</p>
            </div>
        </div>
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
            <form action="{{ route('kepsek.profile.updateProfile') }}" method="POST">
                @csrf
                <input type="hidden" name="id_karyawan" value="{{ $dataPribadi->id_karyawan }}">
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
                                No. HP <span class="text-sm text-gray-400">( need approval )</span>
                            </td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="text" id="no_hp" name="no_hp" value="{{ $dataPribadi->no_hp }}"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    required />
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Email Pribadi</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="text" id="email_pribadi" name="email_pribadi"
                                    value="{{ $dataPribadi->email_pribadi }}"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    required />
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                Agama <span class="text-sm text-gray-400">( need approval )</span>
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
                                Status Nikah <span class="text-sm text-gray-400">( need approval )</span>
                            </td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <select id="status_nikah" name="status_nikah"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option selected>Pilih Status Nikah</option>
                                    <option value="Menikah"
                                        {{ $dataPribadi->status_nikah == 'Menikah' ? 'selected' : '' }}>
                                        Menikah</option>
                                    <option value="Belum Menikah"
                                        {{ $dataPribadi->status_nikah == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah
                                    </option>
                                    <option value="Cerai" {{ $dataPribadi->status_nikah == 'Cerai' ? 'selected' : '' }}>
                                        Cerai
                                    </option>
                                </select>
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
                                <input type="text" id="tinggi_badan" name="tinggi_badan"
                                    value="{{ $dataPribadi->tinggi_badan }}"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    required />
                            </td>
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Berat Badan</td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="text" id="berat_badan" name="berat_badan"
                                    value="{{ $dataPribadi->berat_badan }}"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    required />
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Kewarganegaraan</td>
                            <td class="px-4 py-2 text-gray-500 italic">{{ $dataPribadi->kewarganegaraan }}</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tanggal Bergabung</td>
                            <td class="px-4 py-2 text-gray-500 italic">{{ $dataPribadi->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-end items-center my-5">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
        <div class="my-5 hidden tab-content" id="alamat">
            <div class="flex justify-between items-center my-5">
                <p class="font-GabaritoRegular text-2xl mb-5">Alamat Karyawan</p>


                @if ($countAlamat != 2)
                    <!-- Modal toggle -->
                    <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                        type="button">
                        Tambah Alamat
                    </button>

                    <!-- Main modal -->
                    <div id="default-modal" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow-sm">
                                <!-- Modal header -->
                                <div
                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                                    <h3 class="text-xl font-semibold text-gray-900">
                                        Add New Alamat
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                        data-modal-hide="default-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 md:p-5 space-y-4">
                                    <form action="{{ route('user.profile.add-alamat') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_karyawan"
                                            value="{{ $dataPribadi->id_karyawan }}">
                                        <table class="w-full border border-gray-300 text-sm text-left text-gray-500">
                                            <tbody>
                                                <tr class="border-b">
                                                    <td
                                                        class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                                        Status
                                                        Rumah</td>
                                                    <td class="px-4 py-2 text-gray-500 italic">
                                                        <select id="status_rumah" name="status_rumah"
                                                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                            <option selected>Pilih Status Rumah</option>
                                                            <option value="Sewa">
                                                                Sewa
                                                            </option>
                                                            <option value="Kontrak">
                                                                Kontrak</option>
                                                            <option value="Milik Sendiri">
                                                                Milik Sendiri
                                                            </option>
                                                            <option value="Menumpang">
                                                                Milik Sendiri</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr class="border-b">
                                                    <td
                                                        class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                                        Jenis
                                                        Alamat</td>
                                                    <td class="px-4 py-2 text-gray-500 italic">
                                                        <select id="jenis_alamat" name="jenis_alamat"
                                                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                            @if ($countAlamat < 2)
                                                                @if ($dataAlamat[0]->jenis_alamat == 'Domisili')
                                                                    <option value="KTP">KTP</option>
                                                                @elseif ($dataAlamat[0]->jenis_alamat == 'KTP')
                                                                    <option value="Domisili" selected>Domisili</option>
                                                                @endif
                                                            @endif
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr class="border-b">
                                                    <td
                                                        class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                                        Alamat
                                                    </td>
                                                    <td class="px-4 py-2 text-gray-500 italic">
                                                        <input type="text" name="alamat"
                                                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                            required />
                                                    </td>
                                                </tr>
                                                <tr class="border-b">
                                                    <td
                                                        class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                                        Provinsi
                                                    </td>
                                                    <td class="px-4 py-2">
                                                        @php
                                                            $provinsi = \App\Models\MasterProvinsi::orderBy(
                                                                'nama_provinsi',
                                                            )->get();
                                                        @endphp
                                                        <!-- Provinsi -->
                                                        <select name="provinsi" id="provinsi"
                                                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                            <option value="">Pilih Provinsi</option>
                                                            @foreach ($provinsi as $item)
                                                                <option value="{{ $item->id_provinsi }}">
                                                                    {{ $item->nama_provinsi }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr class="border-b">
                                                    <td
                                                        class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                                        Kota
                                                    </td>
                                                    <td class="px-4 py-2">
                                                        <select name="kota" id="kota"
                                                            class="w-full mt-3 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                            <option value="">Pilih Kota</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr class="border-b">
                                                    <td
                                                        class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                                        Kecamatan
                                                    </td>
                                                    <td class="px-4 py-2">
                                                        <select name="kecamatan" id="kecamatan"
                                                            class="w-full mt-3 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                            <option value="">Pilih Kecamatan</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr class="border-b">
                                                    <td
                                                        class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                                        Kelurahan
                                                    </td>
                                                    <td class="px-4 py-2">
                                                        <select name="id_kelurahan" id="kelurahan"
                                                            class="w-full mt-3 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                            <option value="">Pilih Kelurahan</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr class="border-b">
                                                    <td
                                                        class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                                        Kode
                                                        Pos</td>
                                                    <td class="px-4 py-2 text-gray-500 italic">
                                                        <input type="text" name="kodepos"
                                                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                            required />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="flex justify-end items-end my-5">
                                            <button
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
            @foreach ($dataAlamat as $index => $key)
                <div class="font-GabaritoRegular text-2xl my-5">Alamat {{ $key->jenis_alamat }}</div>
                <form action="{{ route('kepsek.profile.update-alamat') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_alamat" value="{{ $key->id_alamat }}">
                    <table class="w-full border border-gray-300 text-sm text-left text-gray-500">
                        <tbody>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Status Rumah</td>
                                <td class="px-4 py-2 text-gray-500 italic">
                                    <select id="status_rumah" name="status_rumah"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option selected>Pilih Status Rumah</option>
                                        <option value="Sewa" {{ $key->status_rumah == 'Sewa' ? 'selected' : '' }}>
                                            Sewa
                                        </option>
                                        <option value="Kontrak" {{ $key->status_rumah == 'Kontrak' ? 'selected' : '' }}>
                                            Kontrak</option>
                                        <option value="Milik Sendiri"
                                            {{ $key->status_rumah == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri
                                        </option>
                                        <option value="Menumpang"
                                            {{ $key->status_rumah == 'Menumpang' ? 'selected' : '' }}>
                                            Menumpang
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Jenis Alamat</td>
                                <td class="px-4 py-2 text-gray-500 italic">
                                    <select id="jenis_alamat" name="jenis_alamat"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option selected>Pilih Jenis Alamat</option>
                                        <option value="{{ $key->jenis_alamat }}" selected>{{ $key->jenis_alamat }}
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Alamat</td>
                                <td class="px-4 py-2 text-gray-500 italic">
                                    <input type="text" name="alamat" value="{{ $key->alamat }}"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required />
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                    Provinsi
                                </td>
                                <td class="px-4 py-2">
                                    @php
                                        $provinsi = \App\Models\MasterProvinsi::orderBy('nama_provinsi')->get();
                                    @endphp
                                    <!-- Provinsi -->
                                    <select name="provinsi" id="provinsi_{{ $index }}"
                                        id="provinsi_{{ $index }}" data-index="{{ $index }}"
                                        data-selected="{{ $key->id_provinsi }}"
                                        class="w-full
                                        border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2
                                        focus:ring-blue-500">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach ($provinsi as $item)
                                            <option value="{{ $item->id_provinsi }}" {{ $key->id_provinsi == $item->id_provinsi ? 'selected' : '' }}>
                                                {{ $item->nama_provinsi }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                    Kota
                                </td>
                                <td class="px-4 py-2">
                                    <select name="kota" id="kota_{{ $index }}"
                                        data-selected="{{ $key->id_kota }}""
                                        class="w-full
                                        mt-3 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2
                                        focus:ring-blue-500">
                                        <option value="">Pilih Kota</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                    Kecamatan
                                </td>
                                <td class="px-4 py-2">
                                    <select name="kecamatan" id="kecamatan_{{ $index }}"
                                        data-selected="{{ $key->id_kecamatan }}"
                                        class="w-full mt-3 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                    Kelurahan
                                </td>
                                <td class="px-4 py-2">
                                    <select name="id_kelurahan" id="kelurahan_{{ $index }}"
                                        data-selected="{{ $key->id_kelurahan }}""
                                        class="w-full
                                        mt-3 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2
                                        focus:ring-blue-500">
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Kode Pos</td>
                                <td class="px-4 py-2 text-gray-500 italic">
                                    <input type="text" name="kodepos" value="{{ $key->kodepos }}"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex justify-end items-center my-5">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                    </div>
                </form>
            @endforeach
        </div>
        <div class="my-5 hidden tab-content" id="kontak-darurat">
            <div class="flex justify-between items-center my-5">
                <p class="font-GabaritoRegular text-2xl mb-5">Kontak Darurat</p>

                <!-- Modal toggle -->
                <button data-modal-target="kontak-add-modal" data-modal-toggle="kontak-add-modal"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                    type="button">
                    Tambah Kontak Darurat
                </button>

                <!-- Main modal -->
                <div id="kontak-add-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow-sm">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                                <h3 class="text-xl font-semibold text-gray-900">
                                    Add New
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    data-modal-hide="kontak-add-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5 space-y-4">
                                <form action="{{ route('kepsek.profile.store.kondar') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_karyawan" value="{{ $dataPribadi->id_karyawan }}">
                                    <table class="w-full border border-gray-300 text-sm text-left text-gray-500">
                                        <tbody>
                                            <tr class="border-b">
                                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                                    Nama Kontak</td>
                                                <td class="px-4 py-2 text-gray-500 italic">
                                                    <input type="text" name="nama_kontak_darurat"
                                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                        required />
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                                    Nomor Kontak</td>
                                                <td class="px-4 py-2 text-gray-500 italic">
                                                    <input type="text" name="nomor_kontak_darurat"
                                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                        required />
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                                    Hubungan Kontak
                                                    Darurat
                                                </td>
                                                <td class="px-4 py-2 text-gray-500 italic">
                                                    <input type="text" name="hubungan_kontak_darurat"
                                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                        required />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="flex justify-end items-end my-5">
                                        <button
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($dataKontak as $a)
                <form action="{{ route('kepsek.profile.updateKontak') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_kontak_darurat" value="{{ $a->id_kontak_darurat }}">
                    <table class="w-full border border-gray-300 text-sm text-left text-gray-500">
                        <tbody>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Nama Kontak</td>
                                <td class="px-4 py-2 text-gray-500 italic">
                                    <input type="text" name="nama_kontak_darurat"
                                        value="{{ $a->nama_kontak_darurat }}"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required />
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Nomor Kontak</td>
                                <td class="px-4 py-2 text-gray-500 italic">
                                    <input type="text" name="nomor_kontak_darurat"
                                        value="{{ $a->nomor_kontak_darurat }}"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required />
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Hubungan Kontak
                                    Darurat
                                </td>
                                <td class="px-4 py-2 text-gray-500 italic">
                                    <input type="text" name="hubungan_kontak_darurat"
                                        value="{{ $a->hubungan_kontak_darurat }}"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex justify-end items-center my-5 space-x-2">
                        <a href="{{ route('kepsek.profile.delete.kondar', ['id' => $a->id_kontak_darurat]) }}"
                            class="font-GabaritoRegular text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Delete
                        </a>
                        <button
                            class="font-GabaritoRegular text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Simpan
                        </button>
                    </div>
                </form>
            @endforeach
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
            <form action="{{ route('kepsek.profile.updatePenggajian') }}" method="POST">
                @csrf
                <input type="hidden" name="id_karyawan" value="{{ $dataPribadi->id_karyawan }}">
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
                                <span class="text-sm text-gray-400">( need approval )</span>
                            </td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="text" name="no_rekening"
                                    value="{{ $dataPenggajian->no_rekening ?? '' }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            </td>
                        </tr>

                        <!-- no_bpjs_kesehatan (input) -->
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                No. BPJS Kesehatan
                                <span class="text-sm text-gray-400">( need approval )</span>
                            </td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="text" name="no_bpjs_kesehatan"
                                    value="{{ $dataPenggajian->no_bpjs_kesehatan ?? '' }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            </td>
                        </tr>

                        <!-- no_bpjs_ketenagakerjaan (input) -->
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                No. BPJS Ketenagakerjaan
                                <span class="text-sm text-gray-400">( need approval )</span>
                            </td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="text" name="no_bpjs_ketenagakerjaan"
                                    value="{{ $dataPenggajian->no_bpjs_ketenagakerjaan ?? '' }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            </td>
                        </tr>

                        <!-- no_bpjs_pensiun (input) -->
                        <tr class="border-b">
                            <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                No. BPJS Pensiun
                                <span class="text-sm text-gray-400">( need approval )</span>
                            </td>
                            <td class="px-4 py-2 text-gray-500 italic">
                                <input type="text" name="no_bpjs_pensiun"
                                    value="{{ $dataPenggajian->no_bpjs_pensiun ?? '' }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-end items-center my-5">
                    <button
                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>
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

                <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                    type="button">
                    Tambah Pendidikan
                </button>

                <!-- Main modal -->
                <div id="default-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow-sm">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                                <h3 class="text-xl font-semibold text-gray-900">
                                    Terms of Service
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    data-modal-hide="default-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5 space-y-4">
                                <form action="{{ route('kepsek.profile.add-pendidikan') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_karyawan" value="{{ $dataPribadi->id_karyawan }}">
                                    <table class="w-full border border-gray-300 text-sm text-left text-gray-500">
                                        <tbody>
                                            <tr class="border-b">
                                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                                    Tingkat Pendidikan
                                                </td>
                                                <td class="px-4 py-2 text-gray-500 italic">
                                                    <input type="text" name="tingkat_pendidikan"
                                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                                    Institusi</td>
                                                <td class="px-4 py-2 text-gray-500 italic">
                                                    <input type="text" name="institusi"
                                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                                    Jurusan</td>
                                                <td class="px-4 py-2 text-gray-500 italic">
                                                    <input type="text" name="jurusan"
                                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                                    Gelar
                                                </td>
                                                <td class="px-4 py-2 text-gray-500 italic">
                                                    <input type="text" name="gelar"
                                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                                    Tahun
                                                    Masuk</td>
                                                <td class="px-4 py-2 text-gray-500 italic">
                                                    <input type="number" name="tahun_masuk"
                                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                                    Tahun
                                                    Lulus</td>
                                                <td class="px-4 py-2 text-gray-500 italic">
                                                    <input type="number" name="tahun_lulus"
                                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">
                                                    Nilai/IPK</td>
                                                <td class="px-4 py-2 text-gray-500 italic">
                                                    <input type="text" name="nilai"
                                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="flex justify-end items-center my-5">
                                        <button
                                            class="font-GabaritoRegular text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @foreach ($dataPendidikan as $a)
                <form action="{{ route('kepsek.profile.update-pendidikan') }}" method="POST">
                    <input type="hidden" name="id_riwayat_pendidikan" value="{{ $a->id_riwayat_pendidikan }}">
                    @csrf
                    <table class="w-full border border-gray-300 text-sm text-left text-gray-500">
                        <tbody>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tingkat Pendidikan
                                </td>
                                <td class="px-4 py-2 text-gray-500 italic">
                                    <input type="text" name="tingkat_pendidikan" value="{{ $a->tingkat_pendidikan }}"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Institusi</td>
                                <td class="px-4 py-2 text-gray-500 italic">
                                    <input type="text" name="institusi" value="{{ $a->institusi }}"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Jurusan</td>
                                <td class="px-4 py-2 text-gray-500 italic">
                                    <input type="text" name="jurusan" value="{{ $a->jurusan }}"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Gelar</td>
                                <td class="px-4 py-2 text-gray-500 italic">
                                    <input type="text" name="gelar" value="{{ $a->gelar }}"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tahun Masuk</td>
                                <td class="px-4 py-2 text-gray-500 italic">
                                    <input type="number" name="tahun_masuk" value="{{ $a->tahun_masuk }}"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Tahun Lulus</td>
                                <td class="px-4 py-2 text-gray-500 italic">
                                    <input type="number" name="tahun_lulus" value="{{ $a->tahun_lulus }}"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">Nilai/IPK</td>
                                <td class="px-4 py-2 text-gray-500 italic">
                                    <input type="text" name="nilai" value="{{ $a->nilai }}"
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex justify-end mb-10 space-x-5 mt-3">
                        <a href="{{ route('kepsek.profile.delete-pendidikan', ['id' => $a->id_riwayat_pendidikan]) }}"
                            class="font-GabaritoRegular text-white px-4 py-2 rounded-lg text-sm bg-red-600 hover:bg-red-700 transition duration-200">Delete</a>
                        <button
                            class="font-GabaritoRegular text-white px-4 py-2 rounded-lg text-sm bg-[#557EF8] hover:bg-blue-700 transition duration-200">
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
        $(document).ready(function() {
            $('[id^=provinsi_]').each(function() {
                const index = $(this).data('index');
                const selectedProv = $(this).data('selected');
                const selectedKota = $('#kota_' + index).data('selected');
                const selectedKec = $('#kecamatan_' + index).data('selected');
                const selectedKel = $('#kelurahan_' + index).data('selected');

                if (selectedProv) {
                    loadKota(selectedProv, index, selectedKota, selectedKec, selectedKel);
                }
            });

            $(document).on('change', '[id^=provinsi_]', function() {
                const provId = $(this).val();
                const index = $(this).data('index');
                loadKota(provId, index);
            });

            $(document).on('change', '[id^=kota_]', function() {
                const kotaId = $(this).val();
                const index = this.id.split('_')[1];
                loadKecamatan(kotaId, index);
            });

            $(document).on('change', '[id^=kecamatan_]', function() {
                const kecId = $(this).val();
                const index = this.id.split('_')[1];
                loadKelurahan(kecId, index);
            });

            function loadKota(provId, index, selectedKota = null, selectedKec = null, selectedKel = null) {
                $.get('/get-kota/' + provId, function(data) {
                    const kotaSelect = $('#kota_' + index).html('<option value="">Pilih Kota</option>');
                    data.forEach(item => {
                        kotaSelect.append(
                            `<option value="${item.id_kota}" ${selectedKota == item.id_kota ? 'selected' : ''}>${item.nama_kota}</option>`
                        );
                    });

                    if (selectedKota) {
                        loadKecamatan(selectedKota, index, selectedKec, selectedKel);
                    }
                });
            }

            function loadKecamatan(kotaId, index, selectedKec = null, selectedKel = null) {
                $.get('/get-kecamatan/' + kotaId, function(data) {
                    const kecSelect = $('#kecamatan_' + index).html(
                        '<option value="">Pilih Kecamatan</option>');
                    data.forEach(item => {
                        kecSelect.append(
                            `<option value="${item.id_kecamatan}" ${selectedKec == item.id_kecamatan ? 'selected' : ''}>${item.nama_kecamatan}</option>`
                        );
                    });

                    if (selectedKec) {
                        loadKelurahan(selectedKec, index, selectedKel);
                    }
                });
            }

            function loadKelurahan(kecId, index, selectedKel = null) {
                $.get('/get-kelurahan/' + kecId, function(data) {
                    const kelSelect = $('#kelurahan_' + index).html(
                        '<option value="">Pilih Kelurahan</option>');
                    data.forEach(item => {
                        kelSelect.append(
                            `<option value="${item.id_kelurahan}" ${selectedKel == item.id_kelurahan ? 'selected' : ''}>${item.nama_kelurahan}</option>`
                        );
                    });
                });
            }
        });
    </script>
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
