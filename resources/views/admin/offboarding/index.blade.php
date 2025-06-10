@extends('admin.layout.layout')

@section('content-user')
    <div class="flex flex-col justify-start my-5">
        <h3 class="font-GabaritoMedium text-2xl">List Off Boarding</h3>
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <i class="fa-solid fa-chart-line me-3"></i>
                        List
                    </a>
                </li>
            </ol>
        </nav>
    </div>
    <div class="w-full min-h-screen bg-white rounded-xl p-5">
        <h3 class="font-GabaritoRegular text-xl">List Karyawan yang Kontraknya akan segera berakhir</h3>
        <div class="flex justify-end items-center">
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="search-offboarding" name="search-offboarding"
                    class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Cari Karyawan" required />
            </div>
        </div>

        <div class="my-5">
            @foreach ($data as $a)
                <div class="flex justify-between items-center border border-slate-300 p-3 rounded-lg">
                    <div class="flex justify-start items-center space-x-3">
                        <img src="{{ asset('assets/profile-default-2.jpg') }}" class="rounded-full w-16 h-16 shrink-0"
                            alt="">
                        <div class="flex flex-col justify-center leading-tight space-y-[1px]">
                            <div class="flex items-center space-x-3">
                                <p class="font-GabaritoSemiBold text-lg leading-tight">{{ $a->nama_lengkap }}</p>
                                <p class="font-GabaritoRegular text-base text-gray-600">{{ $a->status_karyawan }}</p>
                            </div>
                            <p class="font-GabaritoRegular text-sm leading-tight text-gray-800">{{ $a->jabatan }}</p>
                            <p class="font-GabaritoRegular text-sm leading-tight text-gray-800">
                                Kontrak tersisa <span class="font-GabaritoMedium text-red-600">{{ $a->sisa_kontrak }}
                                    Hari</span>,
                                berakhir {{ $a->akhir_kontrak }}
                            </p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center space-x-3">
                        <form action="{{ route('admin.offboarding.perpanjang') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_karyawan" value="{{ $a->id_karyawan }}">
                            <button
                                class="font-GabaritoRegular text-white px-4 py-1 rounded-full bg-blue-800 text-sm hover:bg-blue-600">Perpanjang</button>
                        </form>
                        <form action="{{ route('admin.offboarding.pengangkatan') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_karyawan" value="{{ $a->id_karyawan }}">
                            <button
                            class="font-GabaritoRegular text-white px-4 py-1 rounded-full bg-green-800 text-sm hover:bg-green-600">Pengangkatan</button>
                        </form>
                        <form action="{{ route('admin.offboarding.layoff') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_karyawan" value="{{ $a->id_karyawan }}">
                            <button
                                class="font-GabaritoRegular text-white px-4 py-1 rounded-full bg-red-800 text-sm hover:bg-red-600">Lay
                                Off</button>
                        </form>
                    </div>
                </div>
            @endforeach
            <div class="flex justify-between items-center mt-4">
                {{-- Info jumlah data --}}
                <div class="text-sm text-gray-600">
                    Menampilkan {{ $data->count() }} dari {{ $data->total() }} data
                </div>

                {{-- Pagination kanan bawah --}}
                <div class="flex justify-end w-full">
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
