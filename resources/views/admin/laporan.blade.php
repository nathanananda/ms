@extends('admin.layout.layout')

@section('content-user')
    <div class="flex justify-between items-center">
        <div class="flex flex-col justify-start my-5">
            <h3 class="font-GabaritoMedium text-2xl">{{ $title }} Kontrak</h3>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <i class="fa-solid fa-chart-line me-3"></i>
                            Laporan
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
                                class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">{{ $title }}</a>
                        </div>
                    </li>

                </ol>
            </nav>
        </div>

        <div class="w-fit h-10 p-3 bg-white rounded-lg shadow-lg">
            <div class="flex justify-between items-center space-x-3">
                <p class="font-GabaritoRegular text-sm">Status Persetujuan</p>
                <p class="font-GabaritoRegular text-sm">{{ $dateNow }}</p>
                <div class="">
                </div>
                <span class="font-GabaritoRegular text-xs bg-[#137D28] py-0.5 px-1.5 rounded-xl text-white">Disetujui 10
                </span>
                <span class="font-GabaritoRegular text-xs bg-[#FFCD00] py-0.5 px-1.5 rounded-xl text-white">Menunggu 10
                </span>
                <span class="font-GabaritoRegular text-xs bg-[#FF2F28] py-0.5 px-1.5 rounded-xl text-white">Ditolak 10
                </span>
            </div>
        </div>
    </div>

    <div class="w-full h-fit bg-white p-5 rounded-xl">
        <table class="table-auto w-full text-sm text-left text-gray-700 border border-gray-300" id="laporan-table">
            <thead class="">
                <tr>
                    <th class="px-4 py-3 font-semibold text-gray-900 border-r border-gray-300">No</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border-r border-gray-300">Nama Karyawan</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border-r ">Jenis Perubahan</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border-r">Jabatan </th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border-r">Status</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border-r">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $i => $a)
                    <tr class="border-t border-gray-300 hover:bg-gray-50 transition">
                        <td class="px-4 py-3 font-medium text-gray-900 border-r border-gray-300">{{ $i + 1 }}
                        </td>
                        <td class="px-4 py-3 text-gray-600 italic border-r border-gray-300">{{ $a->nama_lengkap }}</td>
                        <td class="px-4 py-3 text-gray-600 italic border-r border-gray-300">Perpanjang Kontrak</td>
                        <td class="px-4 py-3 text-gray-600 italic border-r border-gray-300">{{ $a->jabatan }}</td>
                        <td class="px-4 py-3 text-gray-600 italic border-r border-gray-300">{{ $a->status_karyawan }}</td>
                        <td class="px-4 py-3 text-gray-600 italic border-r border-gray-300">
                            Action
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
@section('content-script')
    <script>
        $(document).ready(function() {
            $('#laporan-table').DataTable();
        });
    </script>
@endsection
