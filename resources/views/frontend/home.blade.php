@extends('frontend.layouts.app')

@section('title', 'Beranda - ' . setting('site.title', 'Website Pemerintah'))
@section('description', setting('site.description', 'Website resmi pemerintah yang menyediakan informasi dan layanan kepada masyarakat'))

@section('content')
<!-- Hero Slider -->
@if(isset($sliders) && $sliders->count() > 0)
<section class="relative h-96 md:h-[500px] overflow-hidden">
    <div class="slider-container relative h-full">
        @foreach($sliders as $index => $slider)
        <div class="slider-item absolute inset-0 transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" data-slide="{{ $index }}">
            <div class="relative h-full">
                @if($slider->image_path)
                    @if(Str::startsWith($slider->image_path, ['http://', 'https://']))
                        <img src="{{ $slider->image_path }}" 
                             alt="{{ $slider->title }}" 
                             class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('storage/' . $slider->image_path) }}" 
                             alt="{{ $slider->title }}" 
                             class="w-full h-full object-cover">
                    @endif
                @else
                <div class="w-full h-full government-gradient garuda-pattern"></div>
                @endif
                
                <!-- Overlay -->
                <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                
                <!-- Content -->
                <div class="absolute inset-0 flex items-center">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                        <div class="max-w-3xl">
                            <h2 class="text-3xl md:text-5xl font-bold text-white mb-4">{{ $slider->title }}</h2>
                            @if($slider->description)
                            <p class="text-lg md:text-xl text-gray-200 mb-6">{{ Str::limit(strip_tags($slider->description), 150) }}</p>
                            @endif
                            @if($slider->button_text && $slider->button_url)
                            <a href="{{ $slider->button_url }}" 
                               class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors duration-300">
                                {{ $slider->button_text }}
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Navigation Dots -->
    @if($sliders->count() > 1)
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2">
        @foreach($sliders as $index => $slider)
        <button class="slider-dot w-3 h-3 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-white' : 'bg-white bg-opacity-50' }}" 
                data-slide="{{ $index }}"></button>
        @endforeach
    </div>
    @endif
</section>
@else
{{-- No sliders fallback --}}
<section class="relative h-96 md:h-[500px] overflow-hidden government-gradient garuda-pattern">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="absolute inset-0 flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">Selamat Datang</h1>
            <p class="text-xl md:text-2xl text-blue-100 mb-8">Website Resmi Kementerian Pekerjaan Umum dan Perumahan Rakyat</p>
            <a href="{{ route('about') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors duration-300">
                Tentang Kami
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Quick Access -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Akses Cepat</h2>
            <p class="text-lg text-gray-600">Layanan dan informasi yang sering diakses</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <a href="{{ route('news.index') }}" class="group bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-700 transition-colors">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">Berita Terkini</h3>
                </div>
            </a>
            
            <a href="{{ route('gallery.index') }}" class="group bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-700 transition-colors">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-green-600 transition-colors">Galeri</h3>
                </div>
            </a>
            
            <a href="{{ route('about') }}" class="group bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-700 transition-colors">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-purple-600 transition-colors">Tentang Kami</h3>
                </div>
            </a>
            
            <a href="{{ route('contact') }}" class="group bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <div class="text-center">
                    <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-red-700 transition-colors">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-red-600 transition-colors">Kontak</h3>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Featured News -->
@if(isset($featuredNews) && $featuredNews->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Berita Unggulan</h2>
            <p class="text-lg text-gray-600">Informasi terbaru dan terpenting</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredNews as $news)
            <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                @if($news->featured_image)
                <div class="aspect-w-16 aspect-h-9">
                    <img src="{{ Storage::url($news->featured_image) }}" 
                         alt="{{ $news->featured_image_alt ?? $news->title }}"
                         class="w-full h-48 object-cover">
                </div>
                @endif
                
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full"
                              style="background-color: {{ $news->category->color }}20; color: {{ $news->category->color }}">
                            {{ $news->category->name }}
                        </span>
                        <span class="text-gray-500 text-sm ml-auto">
                            {{ $news->published_at->diffForHumans() }}
                        </span>
                    </div>
                    
                    <h3 class="text-xl font-semibold text-gray-900 mb-3 line-clamp-2 hover:text-blue-600 transition-colors">
                        <a href="{{ route('news.show', $news->slug) }}">{{ $news->title }}</a>
                    </h3>
                    
                    @if($news->excerpt)
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $news->excerpt }}</p>
                    @endif
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm text-gray-600 ml-2">{{ $news->author->name }}</span>
                        </div>
                        <a href="{{ route('news.show', $news->slug) }}" 
                           class="text-blue-600 hover:text-blue-700 font-medium text-sm flex items-center">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('news.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors duration-300">
                Lihat Semua Berita
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Statistics -->
<section class="py-16 government-gradient garuda-pattern">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-white mb-4">Statistik</h2>
            <p class="text-lg text-blue-100">Data dalam angka</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-white mb-2">{{ $latestNews->count() }}+</div>
                <div class="text-blue-100">Berita</div>
            </div>
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-white mb-2">{{ $galleryItems->count() }}+</div>
                <div class="text-blue-100">Galeri</div>
            </div>
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-white mb-2">{{ setting('stats.services', '50') }}+</div>
                <div class="text-blue-100">Layanan</div>
            </div>
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-white mb-2">{{ setting('stats.visitors', '10000') }}+</div>
                <div class="text-blue-100">Pengunjung</div>
            </div>
        </div>
    </div>
</section>

<!-- Latest News -->
@if(isset($latestNews) && $latestNews->count() > 0)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Berita Terbaru</h2>
                <p class="text-lg text-gray-600">Informasi terkini dari kami</p>
            </div>
            <a href="{{ route('news.index') }}" 
               class="hidden md:inline-flex items-center px-6 py-3 border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white font-semibold rounded-lg transition-colors duration-300">
                Lihat Semua
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($latestNews->take(4) as $news)
            <article class="group">
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    @if($news->featured_image)
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="{{ Storage::url($news->featured_image) }}" 
                             alt="{{ $news->featured_image_alt ?? $news->title }}"
                             class="w-full h-32 object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    @endif
                    
                    <div class="p-4">
                        <div class="flex items-center mb-2">
                            <span class="text-xs font-medium px-2 py-1 rounded"
                                  style="background-color: {{ $news->category->color }}20; color: {{ $news->category->color }}">
                                {{ $news->category->name }}
                            </span>
                            <span class="text-gray-500 text-xs ml-auto">
                                {{ $news->published_at->format('d M Y') }}
                            </span>
                        </div>
                        
                        <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
                            <a href="{{ route('news.show', $news->slug) }}">{{ $news->title }}</a>
                        </h3>
                        
                        @if($news->excerpt)
                        <p class="text-gray-600 text-sm line-clamp-2">{{ Str::limit($news->excerpt, 80) }}</p>
                        @endif
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        
        <div class="text-center mt-8 md:hidden">
            <a href="{{ route('news.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors duration-300">
                Lihat Semua Berita
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Gallery Preview -->
@if(isset($galleryItems) && $galleryItems->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Galeri</h2>
            <p class="text-lg text-gray-600">Dokumentasi kegiatan dan momen penting</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach($galleryItems as $item)
            <div class="group cursor-pointer">
                <div class="aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden">
                    @if($item->type === 'image' && $item->file_path)
                    <img src="{{ Storage::url($item->file_path) }}" 
                         alt="{{ $item->title }}"
                         class="w-full h-32 object-cover group-hover:scale-110 transition-transform duration-300">
                    @elseif($item->type === 'video' && $item->thumbnail)
                    <div class="relative">
                        <img src="{{ Storage::url($item->thumbnail) }}" 
                             alt="{{ $item->title }}"
                             class="w-full h-32 object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-12 h-12 bg-black bg-opacity-50 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="w-full h-32 bg-gray-300 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-8">
            <a href="{{ route('gallery.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors duration-300">
                Lihat Semua Galeri
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
@endif
@endsection

@push('scripts')
<script>
    // Hero Slider
    const sliderItems = document.querySelectorAll('.slider-item');
    const sliderDots = document.querySelectorAll('.slider-dot');
    let currentSlide = 0;
    
    function showSlide(index) {
        sliderItems.forEach((item, i) => {
            item.classList.toggle('opacity-100', i === index);
            item.classList.toggle('opacity-0', i !== index);
        });
        
        sliderDots.forEach((dot, i) => {
            dot.classList.toggle('bg-white', i === index);
            dot.classList.toggle('bg-white', i !== index);
            dot.classList.toggle('bg-opacity-50', i !== index);
        });
    }
    
    function nextSlide() {
        currentSlide = (currentSlide + 1) % sliderItems.length;
        showSlide(currentSlide);
    }
    
    // Auto-advance slider
    if (sliderItems.length > 1) {
        setInterval(nextSlide, 5000);
    }
    
    // Dot navigation
    sliderDots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            showSlide(currentSlide);
        });
    });
</script>
@endpush