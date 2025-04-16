@extends('layouts.admin')

@section('title', 'Semua Notifikasi')

@section('content')
<!-- Main Content -->
<div class="p-6">
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Semua Notifikasi</h2>
                <p class="text-gray-600 mt-1">Kelola semua notifikasi Anda</p>
            </div>
            <div class="mt-4 md:mt-0">
                <form action="{{ route('admin.notifications.mark-all-read') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="btn-secondary">
                        <i class="fas fa-check-double mr-2"></i> Tandai Semua Dibaca
                    </button>
                </form>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow-sm" role="alert">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3 text-lg"></i>
            <p>{{ session('success') }}</p>
        </div>
    </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="divide-y divide-gray-200">
            @forelse($notifications as $notification)
                <div class="flex p-5 hover:bg-gray-50 {{ $notification->read_at ? '' : 'bg-indigo-50' }}">
                    <div class="flex-shrink-0 mr-4">
                        <div class="w-12 h-12 {{ $notification->icon_background }} rounded-full flex items-center justify-center {{ $notification->icon_color }}">
                            <i class="{{ $notification->icon }}"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-1">
                            <h3 class="text-base font-semibold {{ $notification->read_at ? 'text-gray-800' : 'text-indigo-700' }}">
                                {{ $notification->title }}
                            </h3>
                            <span class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">{{ $notification->message }}</p>
                        <div class="flex items-center justify-between">
                            @if($notification->link)
                            <a href="{{ $notification->link }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                                <i class="fas fa-external-link-alt mr-1"></i> Lihat Detail
                            </a>
                            @endif
                            
                            <form action="{{ route('admin.notifications.mark-read', $notification->id) }}" method="POST" class="{{ $notification->read_at ? 'hidden' : 'block' }}">
                                @csrf
                                <button type="submit" class="text-xs text-gray-500 hover:text-indigo-600 font-medium">
                                    <i class="fas fa-check mr-1"></i> Tandai Dibaca
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center">
                    <div class="mb-4">
                        <i class="fas fa-bell-slash text-gray-400 text-5xl"></i>
                    </div>
                    <p class="text-gray-600">Tidak ada notifikasi untuk ditampilkan.</p>
                </div>
            @endforelse
        </div>
    </div>
    
    <div class="mt-6">
        {{ $notifications->links() }}
    </div>
</div>
@endsection 