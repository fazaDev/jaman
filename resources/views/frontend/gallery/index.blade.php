@extends('frontend.layouts.app')

@section('title', 'Galeri - ' . setting('site_name', 'Website Pemerintah'))
@section('description', 'Galeri foto dan video dokumentasi kegiatan ' . setting('site_name', 'Website Pemerintah'))

@section('content')
<!-- Page Header -->
<section class="bg-blue-800 py-12">
    <div class="container mx-auto px-4">
        <div class="text-center text-white">
            <h1 class="text-3xl md:text-4xl font-bold mb-4 flex items-center justify-center">
                <i class="fas fa-images text-yellow-400 mr-3"></i>
                Galeri
            </h1>
            <p class="text-lg text-blue-100">Dokumentasi kegiatan dan momen penting {{ setting('site_name', 'PUPR Provinsi Jambi') }}</p>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<section class="bg-gray-100 py-4">
    <div class="container mx-auto px-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
                <li>
                    <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">Beranda</a>
                </li>
                <li>
                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </li>
                <li class="text-blue-800 font-medium">Galeri</li>
            </ol>
        </nav>
    </div>
</section>

<div class="container mx-auto px-4 py-12">
    <!-- Filter Tabs -->
    <div class="flex justify-center mb-8">
        <div class="flex space-x-1 bg-gray-100 p-1 rounded-lg">
            <a href="{{ route('gallery.index') }}"
               class="px-6 py-2 text-sm font-medium rounded-md transition-colors flex items-center {{ request()->routeIs('gallery.index') ? 'bg-blue-800 text-white shadow' : 'text-gray-500 hover:text-blue-800' }}">
                <i class="fas fa-th mr-2"></i>
                Semua
            </a>
            <a href="{{ route('gallery.photos') }}"
               class="px-6 py-2 text-sm font-medium rounded-md transition-colors flex items-center {{ request()->routeIs('gallery.photos') ? 'bg-blue-800 text-white shadow' : 'text-gray-500 hover:text-blue-800' }}">
                <i class="fas fa-image mr-2"></i>
                Foto
            </a>
            <a href="{{ route('gallery.videos') }}"
               class="px-6 py-2 text-sm font-medium rounded-md transition-colors flex items-center {{ request()->routeIs('gallery.videos') ? 'bg-blue-800 text-white shadow' : 'text-gray-500 hover:text-blue-800' }}">
                <i class="fas fa-video mr-2"></i>
                Video
            </a>
        </div>
    </div>

    @if($items->count() > 0)
    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($items as $item)
        <div class="group cursor-pointer gallery-item" data-modal-target="gallery-modal" data-item-id="{{ $item->id }}">
            <div class="aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                @if($item->type === 'image' && $item->file_path)
                <img src="{{ Storage::url($item->file_path) }}"
                     alt="{{ $item->title }}"
                     class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                @elseif($item->type === 'video')
                <div class="relative">
                    @if($item->thumbnail)
                    <img src="{{ Storage::url($item->thumbnail) }}"
                         alt="{{ $item->title }}"
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                    @else
                    <div class="w-full h-64 bg-gray-300 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif

                    <!-- Play Button Overlay -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-16 h-16 bg-black bg-opacity-50 rounded-full flex items-center justify-center group-hover:bg-opacity-70 transition-all">
                            <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                @else
                <div class="w-full h-64 bg-gray-300 flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                @endif

                <!-- Overlay with title -->
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 flex items-end">
                    <div class="p-4 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        <h3 class="font-semibold text-lg mb-1">{{ $item->title }}</h3>
                        @if($item->description)
                        <p class="text-sm text-gray-200">{{ Str::limit($item->description, 60) }}</p>
                        @endif
                        <div class="flex items-center mt-2 text-xs text-gray-300">
                            <i class="fas fa-clock mr-1"></i>
                            {{ $item->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $items->links() }}
    </div>
    @else
    <div class="text-center py-12">
        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-images text-2xl text-blue-800"></i>
        </div>
        <h3 class="text-lg font-medium text-blue-800 mb-2">Belum ada galeri</h3>
        <p class="text-gray-600">Galeri akan ditampilkan di sini ketika sudah tersedia.</p>
    </div>
    @endif
</div>

<!-- Modal -->
<div id="gallery-modal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-90 flex items-center justify-center p-4">
    <div class="relative max-w-7xl max-h-full">
        <!-- Close Button -->
        <button id="close-modal" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Content Container -->
        <div id="modal-content" class="bg-white rounded-lg overflow-hidden max-w-4xl mx-auto">
            <!-- Content will be loaded here -->
        </div>

        <!-- Navigation -->
        <button id="prev-item" class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 bg-black bg-opacity-50 rounded-full p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <button id="next-item" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 bg-black bg-opacity-50 rounded-full p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>
</div>
@endsection

@push('styles')
<style>
    .gallery-item {
        transition: all 0.3s ease;
    }

    .gallery-item:hover {
        transform: translateY(-2px);
    }

    .gallery-item .aspect-w-1 {
        position: relative;
        border: 3px solid transparent;
        transition: border-color 0.3s ease;
    }

    .gallery-item:hover .aspect-w-1 {
        border-color: #f59e0b;
    }
</style>
@endpush
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('gallery-modal');
    const modalContent = document.getElementById('modal-content');
    const closeModal = document.getElementById('close-modal');
    const prevBtn = document.getElementById('prev-item');
    const nextBtn = document.getElementById('next-item');

    let currentItems = @json($items->items());
    let currentIndex = 0;

    // Open modal
    document.querySelectorAll('[data-modal-target="gallery-modal"]').forEach(item => {
        item.addEventListener('click', function() {
            const itemId = parseInt(this.dataset.itemId);
            currentIndex = currentItems.findIndex(item => item.id === itemId);
            showItem(currentIndex);
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    });

    // Close modal
    function closeModalFn() {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    closeModal.addEventListener('click', closeModalFn);

    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModalFn();
        }
    });

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (!modal.classList.contains('hidden')) {
            switch(e.key) {
                case 'Escape':
                    closeModalFn();
                    break;
                case 'ArrowLeft':
                    showPrevious();
                    break;
                case 'ArrowRight':
                    showNext();
                    break;
            }
        }
    });

    // Navigation buttons
    prevBtn.addEventListener('click', showPrevious);
    nextBtn.addEventListener('click', showNext);

    function showPrevious() {
        currentIndex = currentIndex > 0 ? currentIndex - 1 : currentItems.length - 1;
        showItem(currentIndex);
    }

    function showNext() {
        currentIndex = currentIndex < currentItems.length - 1 ? currentIndex + 1 : 0;
        showItem(currentIndex);
    }

    function showItem(index) {
        const item = currentItems[index];
        let content = '';

        if (item.type === 'image') {
            content = `
                <div class="relative">
                    <img src="/storage/${item.file_path}" alt="${item.title}" class="w-full max-h-[70vh] object-contain">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">${item.title}</h3>
                        ${item.description ? `<p class="text-gray-600 mb-4">${item.description}</p>` : ''}
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-clock mr-1"></i>
                            ${new Date(item.created_at).toLocaleDateString('id-ID')}
                        </div>
                    </div>
                </div>
            `;
        } else if (item.type === 'video') {
            content = `
                <div class="relative">
                    ${item.file_path ?
                        `<video controls class="w-full max-h-[70vh]">
                            <source src="/storage/${item.file_path}" type="video/mp4">
                            Browser Anda tidak mendukung pemutar video.
                        </video>` :
                        item.video_url ?
                            `<iframe src="${item.video_url}" class="w-full h-96" frameborder="0" allowfullscreen></iframe>` :
                            '<div class="w-full h-96 bg-gray-200 flex items-center justify-center"><span class="text-gray-500">Video tidak tersedia</span></div>'
                    }
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">${item.title}</h3>
                        ${item.description ? `<p class="text-gray-600 mb-4">${item.description}</p>` : ''}
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-clock mr-1"></i>
                            ${new Date(item.created_at).toLocaleDateString('id-ID')}
                        </div>
                    </div>
                </div>
            `;
        }

        modalContent.innerHTML = content;

        // Update navigation button visibility
        prevBtn.style.display = currentItems.length > 1 ? 'block' : 'none';
        nextBtn.style.display = currentItems.length > 1 ? 'block' : 'none';
    }
});
</script>
@endpush
