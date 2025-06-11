@extends('kepsek.layout.layout')


@section('content-user')
    <div class="flex flex-col justify-start my-5">
        <h3 class="font-GabaritoMedium text-2xl">List Karyawan</h3>
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
                        <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">List
                            Karyawan</a>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="w-full flex justify-between items-end">
        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 space-x-1">
            <li>
                <a href="{{ route('kepsek.karyawan.list', ['status' => 'all']) }}"
                    class="inline-flex px-3 py-1 rounded-t-lg flex-col items-center hover:bg-[#232A3E] hover:text-white {{ request('status') == 'all' ? 'bg-[#232A3E] text-white' : 'bg-gray-300 text-black' }}">
                    <p class="font-GabaritoRegular text-sm">Semua</p>
                    <p class="font-GabaritoRegular text-sm">{{ $totalAll }}</p>
                </a>
            </li>
            @foreach ($StatusAll as $key)
                <li>
                    <a href="{{ route('kepsek.karyawan.list', ['status' => $key->status_karyawan]) }}"
                        class="inline-flex px-3 py-1 rounded-t-lg flex-col items-center hover:bg-[#232A3E] hover:text-white {{ request('status') == $key->status_karyawan ? 'bg-[#232A3E] text-white' : 'bg-gray-300 text-black' }}">
                        <p class="font-GabaritoRegular text-sm">{{ $key->status_karyawan }}</p>
                        <p class="font-GabaritoRegular text-sm">{{ $key->total }}</p>
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="flex flex-col space-y-3 mb-3">
            <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                class="font-GabaritoRegular text-white bg-[#2E994E] px-4 py-1.5 rounded-lg">
                <i class="fa-solid fa-download me-3"></i> Unduh
            </button>
            <!-- Main modal -->
            <div id="default-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-sm">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t bg-[#232A3E] border-gray-200">
                            <h3 class="text-xl font-semibold text-white">
                                Format Unduh Data
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                data-modal-hide="default-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 space-y-4">
                            <form action="{{ route('kepsek.karyawan.export') }}" method="POST">
                                @csrf
                                <table class="w-full table-fixed border border-gray-300">
                                    <tbody>
                                        <tr class="border-b border-gray-300">
                                            <td class="w-1/4 px-4 py-2 font-semibold text-blue-900 align-top">Nama Dokumen
                                            </td>
                                            <td class="px-4 py-2" colspan="2">
                                                <input type="text" name="nama_dokumen"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                    required />

                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-300">
                                            <td class="px-4 py-2 font-semibold text-blue-900 align-top">Field</td>
                                            <td class="px-4 py-2">Semua Field</td>
                                            <td class="px-4 py-2">
                                                <div class="flex items-center mb-4">
                                                    <input id="check-all-field" type="checkbox" name="field[]"
                                                        value="all-field"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 field-checkbox">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-300">
                                            <td class="px-4 py-2 font-semibold text-blue-900 align-top"></td>
                                            <td class="px-4 py-2">Data Pribadi</td>
                                            <td class="px-4 py-2">
                                                <div class="flex items-center mb-4">
                                                    <input id="default-checkbox" type="checkbox" name="field"
                                                        value="data-pribadi"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 field-checkbox">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-300">
                                            <td></td>
                                            <td class="px-4 py-2">Alamat</td>
                                            <td class="px-4 py-2">
                                                <div class="flex items-center mb-4">
                                                    <input id="default-checkbox" type="checkbox" name="field"
                                                        value="alamat"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 field-checkbox">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-300">
                                            <td></td>
                                            <td class="px-4 py-2">Kontak Darurat</td>
                                            <td class="px-4 py-2">
                                                <div class="flex items-center mb-4">
                                                    <input id="default-checkbox" type="checkbox" name="field"
                                                        value="kontak-darurat"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 field-checkbox">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-300">
                                            <td></td>
                                            <td class="px-4 py-2">Kepegawaian</td>
                                            <td class="px-4 py-2">
                                                <div class="flex items-center mb-4">`
                                                    <input id="default-checkbox" type="checkbox" name="field[]"
                                                        value="kepegawaian"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 field-checkbox">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-300">
                                            <td></td>
                                            <td class="px-4 py-2">Penggajian</td>
                                            <td class="px-4 py-2">
                                                <div class="flex items-center mb-4">
                                                    <input id="default-checkbox" type="checkbox" name="field[]"
                                                        value="penggajian"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 field-checkbox">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-300">
                                            <td></td>
                                            <td class="px-4 py-2">Kontrak</td>
                                            <td class="px-4 py-2">
                                                <div class="flex items-center mb-4">
                                                    <input id="default-checkbox" type="checkbox" name="field[]"
                                                        value="kontrak"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 field-checkbox">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-300">
                                            <td></td>
                                            <td class="px-4 py-2">Pendidikan</td>
                                            <td class="px-4 py-2">
                                                <div class="flex items-center mb-4">
                                                    <input id="default-checkbox" type="checkbox" name="field[]"
                                                        value="pendidikan"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 field-checkbox">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-300">
                                            <td class="px-4 py-2 font-semibold text-blue-900 align-top">Banyak Data</td>
                                            <td class="px-4 py-2">Semua Data</td>
                                            <td class="px-4 py-2">
                                                <div class="flex items-center mb-4">
                                                    <input id="check-all-data" type="checkbox" value="all-data"
                                                        name="banyak-data[]"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 data-checkbox">
                                                </div>
                                            </td>
                                        </tr>
                                        @foreach ($StatusAll as $a)
                                            <tr class="border-b border-gray-300">
                                                <td></td>
                                                <td class="px-4 py-2">{{ $a->status_karyawan }}</td>
                                                <td class="px-4 py-2">
                                                    <input id="default-checkbox" type="checkbox"
                                                        value="{{ $a->id_status_karyawan }}" name="banyak-data[]"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 data-checkbox">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="w-full flex justify-center items-center my-5">
                                    <button type="submit"
                                        class="w-full font-GabaritoRegular text-white bg-[#3079C1] px-4 py-1.5 rounded-lg">
                                        Download
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <a class="font-GabaritoRegular text-white bg-[#3079C1] px-4 py-1.5 rounded-lg"
                href="{{ route('admin.karyawan.tambah-karyawan') }}">
                <i class="fa-solid fa-user-plus"></i> Tambah
            </a>


        </div>
    </div>
    <div class="w-full grid grid-cols-3 gap-1">
        @foreach ($listData as $a)
            <div class="w-full h-36 bg-white border border-black p-3">
                <div class="flex justify-between items-start">
                    <div class="flex justify-start space-x-3">
                        <img src="{{ asset('assets/profile-default-2.jpg') }}" class="w-16 h-16 rounded-full"
                            alt="">
                        <div class="flex flex-col justify-center items-start">
                            <h3 class="text-xl font-GabaritoRegular">{{ $a->nama_lengkap }}</h3>
                            <h3 class="text-base font-GabaritoRegular">{{ $a->jabatan }}</h3>
                            <span class="bg-[#F55853] text-white font-GabaritoRegular px-4 rounded-xl">
                                {{ $a->status_karyawan }}
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-1">
                        <a href="{{ route('kepsek.karyawan.detail', ['id' => $a->id_karyawan]) }}"
                            class="bg-blue-600 hover:bg-blue-800 p-1.5 rounded-lg">
                            <i class="fa-solid fa-eye text-white"></i>
                        </a>
                        <a href="{{ route('kepsek.karyawan.update-karyawan', ['id' => $a->id_karyawan]) }}"
                            class="bg-gray-600 hover:bg-gray-800 p-1.5 rounded-lg">
                            <i class="fa-solid fa-pen-to-square text-white"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="flex justify-between items-center mt-4">
        {{-- Info jumlah data --}}
        <div class="text-sm text-gray-600">
            Menampilkan {{ $listData->count() }} dari {{ $listData->total() }} data
        </div>

        {{-- Pagination kanan bawah --}}
        <div class="flex justify-end w-full">
            {{ $listData->links() }}
        </div>
    </div>
@endsection

@section('content-script')
    <script>
        // All Field → check/uncheck semua field
        document.getElementById('check-all-field').addEventListener('change', function() {
            const isChecked = this.checked;
            document.querySelectorAll('.field-checkbox').forEach(cb => {
                cb.checked = isChecked;
            });
        });

        // All Data → check/uncheck semua status data
        document.getElementById('check-all-data').addEventListener('change', function() {
            const isChecked = this.checked;
            document.querySelectorAll('.data-checkbox').forEach(cb => {
                cb.checked = isChecked;
            });
        });
    </script>
@endsection
