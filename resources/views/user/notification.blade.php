@extends('user.layout.layout')

@section('content-user')
    <div class="flex flex-col justify-start my-5">
        <h3 class="font-GabaritoMedium text-2xl">Notification</h3>
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <i class="fa-solid fa-bell me-3"></i>
                        Notification
                    </a>
                </li>
            </ol>
        </nav>
    </div>

    <div class="w-1/4">
        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200">
            <li class="me-1">
                <a href="javascript:void(0)" id="tab-all"
                    class="tab-link inline-flex px-3 py-1 text-black bg-gray-300 rounded-t-lg flex-col items-center hover:bg-[#232A3E] hover:text-white active">
                    <p class="font-GabaritoRegular text-sm">Semua</p>
                    <p class="font-GabaritoRegular text-sm">{{ $AllNotif }}</p>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" id="tab-unread"
                    class="tab-link inline-flex px-3 py-1 text-black bg-gray-300 rounded-t-lg flex-col items-center hover:bg-[#232A3E] hover:text-white">
                    <p class="font-GabaritoRegular text-sm">Belum Dibaca</p>
                    <p class="font-GabaritoRegular text-sm">{{ $UnreadNotif }}</p>
                </a>
            </li>
        </ul>
    </div>
    {{-- Notifikasi Semua --}}
    <div class="tab-content w-full h-fit bg-white space-y-1 rounded-2xl py-3" id="allNotif">
        @foreach ($Notif as $a)
            <div onclick="markAsRead(this)" data-url="{{ route('user.notification.read', ['id' => $a->id_notif]) }}"
                class="cursor-pointer w-full h-24 border border-gray-600 p-4 {{ $a->is_read == 1 ? 'bg-green-200' : 'bg-red-200' }}">
                <div class="flex justify-start items-center space-x-3">
                    <img src="{{ asset('assets/profile-default.jpeg') }}" class="w-14 h-14 rounded-full" alt="">
                    <div>
                        <p class="font-GabaritoMedium text-md">{{ $a->message }}</p>
                        <p class="font-GabaritoRegular text-sm">{{ $a->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Notifikasi Belum Dibaca --}}
    <div class="tab-content w-full h-fit bg-white space-y-1 rounded-2xl py-3 hidden" id="unreadNotif">
        @foreach ($Notif->where('is_read', 0) as $a)
            {{-- filter berdasarkan status --}}
            <div onclick="markAsRead(this)" data-url="{{ route('user.notification.read', ['id' => $a->id_notif]) }}"
                class="cursor-pointer w-full h-24 border border-gray-600 p-4 {{ $a->is_read == 1 ? 'bg-green-200' : 'bg-red-200' }}">
                <div class="flex justify-start items-center space-x-3">
                    <img src="{{ asset('assets/profile-default.jpeg') }}" class="w-14 h-14 rounded-full" alt="">
                    <div>
                        <p class="font-GabaritoMedium text-md">{{ $a->message }}</p>
                        <p class="font-GabaritoRegular text-sm">{{ $a->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('content-script')
    {{-- JavaScript --}}
    <script>
        const tabLinks = document.querySelectorAll('.tab-link');
        const allTab = document.getElementById('allNotif');
        const unreadTab = document.getElementById('unreadNotif');

        tabLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Remove active class dari semua tab
                tabLinks.forEach(l => l.classList.remove('bg-[#232A3E]', 'text-white'));
                tabLinks.forEach(l => l.classList.remove('active'));

                // Tambahkan class aktif ke tab yang diklik
                this.classList.add('bg-[#232A3E]', 'text-white');
                this.classList.add('active');

                // Toggle konten
                if (this.id === 'tab-all') {
                    allTab.classList.remove('hidden');
                    unreadTab.classList.add('hidden');
                } else {
                    unreadTab.classList.remove('hidden');
                    allTab.classList.add('hidden');
                }
            });
        });
    </script>
    <script>
        function markAsRead(el) {
            const url = el.dataset.url;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            }).then(response => {
                if (response.ok) location.reload();
            });
        }
    </script>
@endsection
