@extends('kepsek.layout.layout')

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
            <thead class="">
                <tr>
                    <th class="px-4 py-3 font-semibold text-gray-900 border-r border-gray-300">No</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border-r border-gray-300">Nama Karyawan</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border-r ">Jenis Perubahan</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border-r">Jabatan</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border-r">Status</th>
                    <th class="px-4 py-3 font-semibold text-gray-900 border-r">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataPersetujuanKontrak as $a => $i)
                    <tr class="border-t border-gray-300 hover:bg-gray-50 transition">
                        <td class="px-4 py-3 font-medium text-gray-900 border-r border-gray-300">{{ $a + 1 }}</td>
                        <td class="px-4 py-3 text-gray-600 italic border-r border-gray-300">{{ $i->nama_lengkap }}</td>
                        <td class="px-4 py-3 text-gray-600 italic border-r border-gray-300">{{ $i->tipe_kontrak }}</td>
                        <td class="px-4 py-3 text-gray-600 italic border-r border-gray-300">{{ $i->jabatan }}</td>
                        <td class="px-4 py-3 text-gray-600 italic border-r border-gray-300">{{ $i->status_karyawan }}</td>
                        <td class="px-4 py-3 text-gray-600 italic border-r border-gray-300">
                            <div class="flex justify-between items-center">
                                <!-- Tombol Tolak & Modal -->
                                <a href="{{ route('kepsek.laporan.persetujuan.detail', ['id' => $i->uuid]) }}" class="bg-blue-400 py-1 px-2 rounded text-white" type="button">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <!-- Tombol Tolak & Modal -->
                                <button data-modal-target="modal-tolak-{{ $i->uuid }}"
                                    data-modal-toggle="modal-tolak-{{ $i->uuid }}"
                                    class="bg-red-400 py-1 px-2 rounded text-white" type="button">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>

                                <!-- Modal Penolakan -->
                                <div id="modal-tolak-{{ $i->uuid }}" tabindex="-1" aria-hidden="true"
                                    class="hidden fixed top-0 right-0 left-0 z-50  justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full overflow-y-auto overflow-x-hidden">

                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <div class="relative bg-white rounded-lg shadow-sm">

                                            <!-- Header -->
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                                                <h3 class="text-xl font-semibold text-gray-900">
                                                    Penolakan Persetujuan
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                    data-modal-hide="modal-tolak-{{ $i->uuid }}">
                                                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Body -->
                                            <div class="p-4 md:p-5 space-y-4">
                                                <form action="{{ route('kepsek.laporan.persetujuan.reject-kontrak') }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id_kontrak" value="{{ $i->uuid }}">
                                                    <div class="font-GabaritoRegular">
                                                        <label for="catatan"
                                                            class="block mb-2 text-sm font-medium text-gray-900">Catatan
                                                            Kepsek</label>
                                                        <textarea id="catatan" name="catatan" rows="4" required
                                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                                            placeholder="Write your thoughts here..."></textarea>
                                                    </div>
                                                    <div class="flex justify-end items-center my-3">
                                                        <button
                                                            class="font-GabaritoRegular text-white px-4 py-1.5 rounded-lg text-sm bg-red-400 hover:bg-red-700 transition duration-200">Reject</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @php
                                    $redirectUrls = [
                                        'Perpanjang' => route('kepsek.laporan.persetujuan.perpanjang', [
                                            'id' => $i->uuid,
                                        ]),
                                        'Pemberhentian' => route('kepsek.laporan.persetujuan.pemberhentian', [
                                            'id' => $i->uuid,
                                        ]),
                                        'Pengangkatan' => route('kepsek.laporan.persetujuan.pengangkatan', [
                                            'id' => $i->uuid,
                                        ]),
                                        'Penambahan' => route('kepsek.laporan.persetujuan.penambahan', [
                                            'id' => $i->uuid,
                                        ]),
                                    ];
                                @endphp

                                @if (array_key_exists($i->tipe_kontrak, $redirectUrls))
                                    <a href="{{ $redirectUrls[$i->tipe_kontrak] }}"
                                        class="bg-green-400 p-1 px-1.5 rounded text-white">
                                        <i class="fa-solid fa-check"></i>
                                    </a>
                                @endif

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
