@extends('admin.layout.layout')

@section('content-user')
    <div class="flex justify-between items-center">
        <div class="flex flex-col justify-start my-5">
            <h3 class="font-GabaritoMedium text-2xl">Laporan Persetujuan</h3>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <i class="fa-solid fa-chart-line me-3"></i>
                            Laporan Persetujuan
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
                                class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">List</a>
                        </div>
                    </li>

                </ol>
            </nav>
        </div>
    </div>

    <div class="w-full h-fit bg-white p-5 rounded-xl">
        <table class="table-auto w-full text-sm text-left text-gray-700 border border-gray-300" id="laporan-table">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 font-semibold text-gray-900 border border-gray-300">No</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border border-gray-300">Nama Karyawan</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border border-gray-300">Jenis Perubahan</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border border-gray-300">Field</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border border-gray-300">Value Lama</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border border-gray-300">Value Baru</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border border-gray-300">Jabatan</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border border-gray-300">Status</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border border-gray-300">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataPengajuan as $a => $i)
                    <tr class="odd:bg-white even:bg-gray-50 border border-gray-300 transition hover:bg-gray-100">
                        <td class="px-4 py-3 font-medium text-gray-900 border border-gray-300">{{ $a + 1 }}</td>
                        <td class="px-4 py-3 text-gray-600 italic border border-gray-300">{{ $i->nama_lengkap }}</td>
                        <td class="px-4 py-3 text-gray-600 italic border border-gray-300">Perubahan Data</td>
                        <td class="px-4 py-3 text-gray-600 italic border border-gray-300">{{ $i->field }}</td>
                        <td class="px-4 py-3 text-gray-600 italic border border-gray-300">{{ $i->value_lama ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-600 italic border border-gray-300">{{ $i->value_baru }}</td>
                        <td class="px-4 py-3 text-gray-600 italic border border-gray-300">{{ $i->jabatan }}</td>
                        <td class="px-4 py-3 text-gray-600 italic border border-gray-300">{{ $i->status_karyawan }}</td>
                        <td class="px-4 py-3 text-gray-600 italic border border-gray-300">
                            <div class="flex justify-between items-center space-x-3">
                                <form action="{{ route('admin.laporan.persetujuan.approve', ['id' => $i->id_history]) }}"
                                    method="GET">
                                    @csrf
                                    <input type="hidden" name="id_history" value="{{ $i->id_history }}">
                                    <button
                                        class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition">Approve</button>
                                </form>
                                <form action="{{ route('admin.laporan.persetujuan.reject', ['id' => $i->id_history]) }}"
                                    method="GET">
                                    @csrf
                                    <input type="hidden" name="id_history" value="{{ $i->id_history }}">
                                    <button
                                        class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 transition">Reject</button>
                                </form>
                            </div>
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
