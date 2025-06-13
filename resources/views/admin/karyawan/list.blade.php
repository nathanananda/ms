@extends('admin.layout.layout')


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
                <a href="{{ route('admin.karyawan.list', ['status' => 'all']) }}"
                    class="inline-flex px-3 py-1 rounded-t-lg flex-col items-center hover:bg-[#232A3E] hover:text-white {{ request('status') == 'all' ? 'bg-[#232A3E] text-white' : 'bg-gray-300 text-black' }}">
                    <p class="font-GabaritoRegular text-sm">Semua</p>
                    <p class="font-GabaritoRegular text-sm">{{ $totalAll }}</p>
                </a>
            </li>
            @foreach ($StatusAll as $key)
                <li>
                    <a href="{{ route('admin.karyawan.list', ['status' => $key->status_karyawan]) }}"
                        class="inline-flex px-3 py-1 rounded-t-lg flex-col items-center hover:bg-[#232A3E] hover:text-white {{ request('status') == $key->status_karyawan ? 'bg-[#232A3E] text-white' : 'bg-gray-300 text-black' }}">
                        <p class="font-GabaritoRegular text-sm">{{ $key->status_karyawan }}</p>
                        <p class="font-GabaritoRegular text-sm">{{ $key->total }}</p>
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="flex flex-col space-y-3 mb-3">
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
                            <span
                                class="{{ $listWarna[$a->status_karyawan] }} text-white px-4 rounded-xl">
                                {{ $a->status_karyawan }}
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-1">
                        <a href="{{ route('admin.karyawan.detail', ['id' => $a->id_karyawan]) }}"
                            class="bg-blue-600 hover:bg-blue-800 p-1.5 rounded-lg">
                            <i class="fa-solid fa-eye text-white"></i>
                        </a>
                        <a href="{{ route('admin.karyawan.update-karyawan', ['id' => $a->id_karyawan]) }}"
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
