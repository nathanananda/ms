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
        <div class="flex justify-between items-center">
            <h3 class="font-GabaritoRegular text-xl">List Karyawan yang Kontraknya akan segera berakhir</h3>
            <form method="GET" action="{{ route('admin.offboarding') }}" id="searchForm">
                <input type="text" name="search" id="searchInput" class="border border-slate-300 px-3 py-1 rounded-lg"
                    placeholder="Cari Karyawan.." value="{{ request('search') }}">
            </form>
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
@section('content-script')
    <script>
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');

        let timer = null;
        searchInput.addEventListener('input', function() {
            clearTimeout(timer);
            timer = setTimeout(() => {
                searchForm.submit();
            }, 500); // Tunggu 500ms setelah user berhenti mengetik
        });
    </script>
@endsection
