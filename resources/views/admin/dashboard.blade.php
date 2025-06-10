@extends('admin.layout.layout')

@section('content-user')
    <div class="flex flex-col justify-start my-5">
        <h3 class="font-GabaritoMedium text-2xl">Dashboard</h3>
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <i class="fa-solid fa-chart-line me-3"></i>
                        Dashboard
                    </a>
                </li>
            </ol>
        </nav>
    </div>
    <div class="w-full grid grid-cols-3 gap-5">
        <div class="col-span-3">
            <div class="w-1/3 h-48 bg-[#1778BF] flex flex-col items-start justify-between rounded-xl p-5">
                <h3 class="font-GabaritoMedium text-2xl text-white tracking-wider">Total Karyawan</h3>
                <div class="w-full flex justify-between items-end">
                    <h1 class="font-GabaritoRegular font-semibold text-6xl text-white">{{ $countKaryawan }}</h1>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="140" height="140" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-users text-white">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
