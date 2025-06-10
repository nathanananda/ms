@extends('admin.layout.layout')

@section('content-user')
    <div class="flex flex-col justify-start">
        <h3 class="font-GabaritoMedium text-2xl">Finansial</h3>
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
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Finansial</a>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="w-full h-fit bg-white rounded-lg my-5 p-5">
        <h3 class="font-GabaritoRegular text-2xl mb-4">Finansial Anda</h3>
        <table class="table-auto w-full text-sm text-left text-gray-700 border border-gray-200">
            <tbody>
                <tr class="border-b">
                    <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300 w-1/3">Kode Golongan</td>
                    <td class="px-4 py-2 text-gray-500 italic">{{ $dataPenggajian->kode_golongan }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300 w-1/3">Jenis Tunjangan</td>
                    <td class="px-4 py-2 text-gray-500 italic">{{ $dataPenggajian->jenis_tunjangan == '' ? '-' : $dataPenggajian->jenis_tunjangan }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">NPWP</td>
                    <td class="px-4 py-2 text-gray-500 italic">{{ $dataPenggajian->npwp }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">No. Rekening</td>
                    <td class="px-4 py-2 text-gray-500 italic">{{ $dataPenggajian->no_rekening }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">No BPJS Kesehatan</td>
                    <td class="px-4 py-2 text-gray-500 italic">{{ $dataPenggajian->no_bpjs_kesehatan }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">No BPJS Ketenagakerjaan</td>
                    <td class="px-4 py-2 text-gray-500 italic">{{ $dataPenggajian->no_bpjs_ketenagakerjaan }}</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300">No BPJS Pensiun</td>
                    <td class="px-4 py-2 text-gray-500 italic">{{ $dataPenggajian->no_bpjs_pensiun }}</td>
                </tr>
            </tbody>
        </table>
    </div>
{{--
    <div class="w-full h-fit bg-white rounded-lg my-5 p-5">
        <h3 class="font-GabaritoRegular text-2xl mb-4">Riwayat Gaji</h3>
        <table class="table-auto w-full text-sm text-left text-gray-700 border border-gray-200">
            <thead>
                <tr class="border-b">
                    <th class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300 w-1/3">Jenis Tunjangan</th>
                    <th class="px-4 py-2 font-medium text-gray-900 border-r border-gray-300 w-1/3">Periode</th>
                    <th class="px-4 py-2 font-medium text-gray-900 w-1/3">Nominal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @while ($i < 10)
                    @php
                        $i++;
                    @endphp
                    <tr class="border-b">
                        <td class="px-4 py-2 border-r text-black">Gaji Pokok</td>
                        <td class="px-4 py-2 border-r text-black">Mei 2025</td>
                        <td class="px-4 py-2 border-r text-black">{{ rupiah(10000000) }}</td>
                    </tr>
                @endwhile
            </tbody>
        </table>

    </div> --}}
@endsection
