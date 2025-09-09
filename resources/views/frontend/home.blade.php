@extends('frontend.layouts.app')

@section('title', 'Beranda - ' . setting('site.title', 'Website Pemerintah'))
@section('description', setting('site.description', 'Website resmi pemerintah yang menyediakan informasi dan layanan kepada masyarakat'))

@section('content')
<!-- Hero Slider -->
@if(isset($sliders) && $sliders->count() > 0)
<!-- Dynamic Hero Slider -->
<div class="hero-slider relative overflow-hidden" style="height: calc(100vh - 140px);" id="heroSlider">
    @foreach($sliders as $index => $slider)
    <div class="slider-item absolute inset-0 transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" data-slide="{{ $index }}">
        @if($slider->image_path && !Str::startsWith($slider->image_path, ['http://', 'https://']))
            <img src="{{ asset('storage/' . $slider->image_path) }}"
                 alt="{{ $slider->title }}"
                 class="w-full h-full object-cover">
        @else
            <div class="w-full h-full government-gradient garuda-pattern"></div>
        @endif

        <!-- Slider Content Overlay -->
        @if($slider->title || $slider->description)
        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
            <div class="text-center text-white px-4 max-w-4xl">
                @if($slider->title)
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4 drop-shadow-lg">{{ $slider->title }}</h1>
                @endif
                @if($slider->description)
                <p class="text-lg md:text-xl lg:text-2xl text-blue-100 mb-6 drop-shadow-md">{{ $slider->description }}</p>
                @endif
                @if($slider->button_url)
                <a href="{{ $slider->button_url }}"
                   {{ $slider->button_new_tab ? 'target="_blank"' : '' }}
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg transition-colors duration-300 shadow-lg">
                    {{ $slider->button_text ?: 'Selengkapnya' }}
                </a>
                @endif
            </div>
        </div>
        @endif
    </div>
    @endforeach

    <!-- Slider Navigation -->
    @if($sliders->count() > 1)
    <!-- Previous/Next Buttons -->
    <button id="prevBtn" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-70 text-white p-3 rounded-full transition-all duration-300 z-10">
        <i class="fas fa-chevron-left"></i>
    </button>
    <button id="nextBtn" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-70 text-white p-3 rounded-full transition-all duration-300 z-10">
        <i class="fas fa-chevron-right"></i>
    </button>

    <!-- Dots Indicator -->
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
        @foreach($sliders as $index => $slider)
        <button class="slider-dot w-3 h-3 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-white' : 'bg-white bg-opacity-50' }}"
                data-slide="{{ $index }}"></button>
        @endforeach
    </div>
    @endif
</div>
@else
{{-- No sliders fallback --}}
<div class="hero-slider bg-gray-200 relative overflow-hidden" style="height: calc(100vh - 140px);">
    <div class="w-full h-full government-gradient garuda-pattern flex items-center justify-center">
        <div class="text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Selamat Datang</h1>
            <p class="text-xl md:text-2xl text-blue-100">Website Resmi {{ setting('site.title', 'PUPR Provinsi Jambi') }}</p>
        </div>
    </div>
</div>
@endif

<!-- Breaking News Ticker -->
<div class="bg-yellow-400 py-3 px-4">
    <div class="container mx-auto">
        <div class="flex items-center">
            <div class="bg-blue-800 text-white px-3 py-1 rounded-md mr-4 font-bold whitespace-nowrap flex items-center">
                <i class="fas fa-star mr-2"></i>
                BERITA UNGGULAN
                @if(isset($featuredNews) && $featuredNews->count() > 0)
                    <span class="ml-2 bg-yellow-400 text-blue-800 px-2 py-0.5 rounded-full text-xs font-bold">{{ $featuredNews->count() }}</span>
                @endif
            </div>
            <div class="marquee-container overflow-hidden flex-1">
                <div class="marquee-content text-blue-900 font-medium">
                    @if(isset($featuredNews) && $featuredNews->count() > 0)
                        @foreach($featuredNews->take(5) as $news)
                            <a href="{{ route('news.show', $news->slug) }}" class="mr-8 hover:text-blue-700 transition-colors inline-flex items-center">
                                <i class="fas fa-star text-yellow-600 mr-2 text-xs"></i>
                                <span class="text-xs bg-yellow-500 text-blue-900 px-2 py-1 rounded mr-2 font-bold">{{ $news->category->name }}</span>
                                {{ Str::limit($news->title, 70) }}
                                <span class="text-xs text-blue-700 ml-2">({{ $news->published_at->format('d/m') }})</span>
                            </a>
                        @endforeach
                        <!-- Repeat for seamless loop -->
                        @foreach($featuredNews->take(5) as $news)
                            <a href="{{ route('news.show', $news->slug) }}" class="mr-8 hover:text-blue-700 transition-colors inline-flex items-center">
                                <i class="fas fa-star text-yellow-600 mr-2 text-xs"></i>
                                <span class="text-xs bg-yellow-500 text-blue-900 px-2 py-1 rounded mr-2 font-bold">{{ $news->category->name }}</span>
                                {{ Str::limit($news->title, 70) }}
                                <span class="text-xs text-blue-700 ml-2">({{ $news->published_at->format('d/m') }})</span>
                            </a>
                        @endforeach
                    @else
                        <span class="mr-8">
                            <i class="fas fa-star text-yellow-600 mr-2 text-xs"></i>Selamat datang di website resmi {{ setting('site.title', 'PUPR Provinsi Jambi') }}
                        </span>
                        <span class="mr-8">
                            <i class="fas fa-star text-yellow-600 mr-2 text-xs"></i>Berita unggulan akan ditampilkan di sini
                        </span>
                        <span class="mr-8">
                            <i class="fas fa-star text-yellow-600 mr-2 text-xs"></i>Pantau terus update berita dan informasi terbaru
                        </span>
                        <!-- Repeat for seamless loop -->
                        <span class="mr-8">
                            <i class="fas fa-star text-yellow-600 mr-2 text-xs"></i>Selamat datang di website resmi {{ setting('site.title', 'PUPR Provinsi Jambi') }}
                        </span>
                        <span class="mr-8">
                            <i class="fas fa-star text-yellow-600 mr-2 text-xs"></i>Berita unggulan akan ditampilkan di sini
                        </span>
                        <span class="mr-8">
                            <i class="fas fa-star text-yellow-600 mr-2 text-xs"></i>Pantau terus update berita dan informasi terbaru
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Access -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-blue-800 mb-4 flex items-center justify-center">
                <i class="fas fa-bolt text-yellow-400 mr-3"></i>
                Akses Cepat
            </h2>
            <p class="text-lg text-gray-600">Layanan dan informasi yang sering diakses</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <a href="{{ route('news.index') }}" class="group bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-blue-200 hover:border-yellow-400">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-800 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-yellow-400 transition-colors">
                        <i class="fas fa-newspaper text-white group-hover:text-blue-800 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold text-blue-800 group-hover:text-yellow-600 transition-colors">Berita Terkini</h3>
                </div>
            </a>

            <a href="{{ route('gallery.index') }}" class="group bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-blue-200 hover:border-yellow-400">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-800 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-yellow-400 transition-colors">
                        <i class="fas fa-images text-white group-hover:text-blue-800 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold text-blue-800 group-hover:text-yellow-600 transition-colors">Galeri</h3>
                </div>
            </a>

            <a href="{{ route('about') }}" class="group bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-blue-200 hover:border-yellow-400">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-800 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-yellow-400 transition-colors">
                        <i class="fas fa-info-circle text-white group-hover:text-blue-800 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold text-blue-800 group-hover:text-yellow-600 transition-colors">Tentang Kami</h3>
                </div>
            </a>

            <a href="{{ route('contact') }}" class="group bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-blue-200 hover:border-yellow-400">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-800 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-yellow-400 transition-colors">
                        <i class="fas fa-phone text-white group-hover:text-blue-800 text-2xl"></i>
                    </div>
                    <h3 class="font-semibold text-blue-800 group-hover:text-yellow-600 transition-colors">Kontak</h3>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- News Section -->
@if(isset($featuredNews) && $featuredNews->count() > 0)
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-2xl font-bold text-blue-800">Berita Terkini</h3>
            <a href="{{ route('news.index') }}" class="text-blue-800 hover:text-yellow-600 font-medium flex items-center">
                Lihat Semua <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredNews->take(3) as $news)
            <div class="bg-white rounded-lg overflow-hidden shadow-md news-card transition duration-300">
                @if($news->featured_image)
                <img src="{{ Storage::url($news->featured_image) }}" alt="{{ $news->title }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-blue-800 font-medium">{{ $news->published_at->format('d M Y') }}</span>
                        <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">{{ $news->category->name }}</span>
                    </div>
                    <h4 class="text-lg font-bold text-blue-800 mb-2">{{ $news->title }}</h4>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($news->excerpt ?? strip_tags($news->content), 100) }}...</p>
                    <a href="{{ route('news.show', $news->slug) }}" class="text-blue-800 hover:text-yellow-600 font-medium text-sm flex items-center">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Announcement & Events -->
<div class="bg-white py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Announcement -->
            <div>
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-blue-800">Pengumuman</h3>
                    <a href="#" class="text-blue-800 hover:text-yellow-600 font-medium flex items-center">
                        Lihat Semua <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <div class="bg-blue-50 rounded-lg p-4 mb-4">
                    <div class="flex items-start">
                        <div class="bg-blue-800 text-white rounded-full w-10 h-10 flex items-center justify-center mr-4">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-blue-800 mb-1">Penerimaan CPNS {{ setting('site.title', 'PUPR') }} {{ date('Y') }}</h4>
                            <p class="text-gray-600 text-sm mb-2">Pendaftaran Calon Pegawai Negeri Sipil akan dibuka sesuai jadwal yang telah ditetapkan pemerintah.</p>
                            <span class="text-xs text-blue-800">{{ now()->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 rounded-lg p-4 mb-4">
                    <div class="flex items-start">
                        <div class="bg-blue-800 text-white rounded-full w-10 h-10 flex items-center justify-center mr-4">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-blue-800 mb-1">Informasi Pelayanan Publik</h4>
                            <p class="text-gray-600 text-sm mb-2">Pelayanan publik tetap berjalan normal dengan protokol kesehatan yang ketat untuk kenyamanan masyarakat.</p>
                            <span class="text-xs text-blue-800">{{ now()->subDays(1)->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 rounded-lg p-4">
                    <div class="flex items-start">
                        <div class="bg-blue-800 text-white rounded-full w-10 h-10 flex items-center justify-center mr-4">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-blue-800 mb-1">Perubahan Jam Pelayanan</h4>
                            <p class="text-gray-600 text-sm mb-2">Jam pelayanan berubah menjadi 08.00-15.00 WIB untuk memberikan pelayanan yang lebih optimal.</p>
                            <span class="text-xs text-blue-800">{{ now()->subDays(2)->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Events -->
            <div>
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-blue-800">Agenda Kegiatan</h3>
                    <a href="#" class="text-blue-800 hover:text-yellow-600 font-medium flex items-center">
                        Lihat Semua <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <div class="bg-yellow-50 rounded-lg p-4 mb-4">
                    <div class="flex items-start">
                        <div class="bg-yellow-400 text-blue-900 rounded-lg w-16 h-16 flex flex-col items-center justify-center mr-4 text-center">
                            <span class="font-bold text-xl">{{ now()->addDays(5)->format('d') }}</span>
                            <span class="text-xs">{{ strtoupper(now()->addDays(5)->format('M')) }}</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-blue-800 mb-1">Rapat Koordinasi Pembangunan Daerah</h4>
                            <p class="text-gray-600 text-sm mb-2">Kantor {{ setting('site.title', 'PUPR') }}, Jambi | 09.00-12.00 WIB</p>
                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Pemerintahan</span>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-50 rounded-lg p-4 mb-4">
                    <div class="flex items-start">
                        <div class="bg-yellow-400 text-blue-900 rounded-lg w-16 h-16 flex flex-col items-center justify-center mr-4 text-center">
                            <span class="font-bold text-xl">{{ now()->addDays(10)->format('d') }}</span>
                            <span class="text-xs">{{ strtoupper(now()->addDays(10)->format('M')) }}</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-blue-800 mb-1">Sosialisasi Program Pembangunan</h4>
                            <p class="text-gray-600 text-sm mb-2">Aula Kantor Gubernur, Jambi | 08.00-16.00 WIB</p>
                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Sosialisasi</span>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-50 rounded-lg p-4">
                    <div class="flex items-start">
                        <div class="bg-yellow-400 text-blue-900 rounded-lg w-16 h-16 flex flex-col items-center justify-center mr-4 text-center">
                            <span class="font-bold text-xl">{{ now()->addDays(15)->format('d') }}</span>
                            <span class="text-xs">{{ strtoupper(now()->addDays(15)->format('M')) }}</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-blue-800 mb-1">Pelatihan Teknis {{ setting('site.title', 'PUPR') }}</h4>
                            <p class="text-gray-600 text-sm mb-2">Gedung Pelatihan, Jambi | 13.00-16.00 WIB</p>
                            <span class="text-xs bg-purple-100 text-purple-800 px-2 py-1 rounded-full">Pelatihan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics -->
<div class="bg-blue-800 text-white py-12">
    <div class="container mx-auto px-4">
        <h3 class="text-2xl font-bold text-center mb-8">Data & Statistik Provinsi Jambi</h3>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-blue-700 rounded-lg p-6 text-center">
                <div class="text-4xl font-bold mb-2">{{ setting('stats.districts', '11') }}</div>
                <div class="text-sm">Kabupaten/Kota</div>
            </div>
            <div class="bg-blue-700 rounded-lg p-6 text-center">
                <div class="text-4xl font-bold mb-2">{{ setting('stats.population', '3.6') }}</div>
                <div class="text-sm">Juta Penduduk</div>
            </div>
            <div class="bg-blue-700 rounded-lg p-6 text-center">
                <div class="text-4xl font-bold mb-2">{{ setting('stats.growth', '5.2') }}%</div>
                <div class="text-sm">Pertumbuhan Ekonomi</div>
            </div>
            <div class="bg-blue-700 rounded-lg p-6 text-center">
                <div class="text-4xl font-bold mb-2">{{ setting('stats.tourists', '2.1') }}</div>
                <div class="text-sm">Juta Wisatawan</div>
            </div>
        </div>

        <div class="text-center mt-8">
            <a href="#" class="inline-block bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-bold py-3 px-6 rounded-lg shadow-lg transition duration-300">
                Lihat Data Lengkap
            </a>
        </div>
    </div>
</div>

<!-- Video Gallery -->
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-2xl font-bold text-blue-800">Galeri Video</h3>
            <a href="{{ route('gallery.index') }}" class="text-blue-800 hover:text-yellow-600 font-medium flex items-center">
                Lihat Semua <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if(isset($galleryItems) && $galleryItems->where('type', 'video')->count() > 0)
                @foreach($galleryItems->where('type', 'video')->take(3) as $video)
                <div class="bg-white rounded-lg overflow-hidden shadow-md">
                    <div class="relative pt-[56.25%]">
                        @if($video->file_path && Str::contains($video->file_path, ['youtube.com', 'youtu.be']))
                            <iframe class="absolute top-0 left-0 w-full h-full" src="{{ $video->file_path }}" frameborder="0" allowfullscreen></iframe>
                        @elseif($video->thumbnail)
                            <img src="{{ Storage::url($video->thumbnail) }}" alt="{{ $video->title }}" class="absolute top-0 left-0 w-full h-full object-cover">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-16 h-16 bg-black bg-opacity-50 rounded-full flex items-center justify-center">
                                    <i class="fas fa-play text-white text-2xl ml-1"></i>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-blue-800 mb-2">{{ $video->title }}</h4>
                        <p class="text-gray-600 text-sm">{{ $video->created_at->format('d M Y') }} | {{ $video->views ?? '0' }} views</p>
                    </div>
                </div>
                @endforeach
            @else
                <!-- Default video placeholders when no videos available -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md">
                    <div class="relative pt-[56.25%]">
                        <div class="absolute top-0 left-0 w-full h-full bg-gray-200 flex items-center justify-center">
                            <div class="w-16 h-16 bg-blue-800 rounded-full flex items-center justify-center">
                                <i class="fas fa-play text-white text-2xl ml-1"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-blue-800 mb-2">Profil {{ setting('site.title', 'PUPR') }}</h4>
                        <p class="text-gray-600 text-sm">{{ now()->format('d M Y') }} | 1.245 views</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg overflow-hidden shadow-md">
                    <div class="relative pt-[56.25%]">
                        <div class="absolute top-0 left-0 w-full h-full bg-gray-200 flex items-center justify-center">
                            <div class="w-16 h-16 bg-blue-800 rounded-full flex items-center justify-center">
                                <i class="fas fa-play text-white text-2xl ml-1"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-blue-800 mb-2">Kegiatan Pembangunan Infrastruktur</h4>
                        <p class="text-gray-600 text-sm">{{ now()->subDays(2)->format('d M Y') }} | 2.567 views</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg overflow-hidden shadow-md">
                    <div class="relative pt-[56.25%]">
                        <div class="absolute top-0 left-0 w-full h-full bg-gray-200 flex items-center justify-center">
                            <div class="w-16 h-16 bg-blue-800 rounded-full flex items-center justify-center">
                                <i class="fas fa-play text-white text-2xl ml-1"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-blue-800 mb-2">Sosialisasi Program {{ setting('site.title', 'PUPR') }}</h4>
                        <p class="text-gray-600 text-sm">{{ now()->subDays(5)->format('d M Y') }} | 3.102 views</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

@push('scripts')
<style>
/* Hero Slider Styles */
.hero-slider {
    background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
}

.slider-item {
    transition: opacity 0.8s ease-in-out;
}

.slider-dot {
    cursor: pointer;
    transition: all 0.3s ease;
}

.slider-dot:hover {
    transform: scale(1.2);
}

#prevBtn, #nextBtn {
    backdrop-filter: blur(4px);
    transition: all 0.3s ease;
}

#prevBtn:hover, #nextBtn:hover {
    transform: scale(1.1);
    backdrop-filter: blur(8px);
}

/* Mobile responsive adjustments */
@media (max-width: 768px) {
    .hero-slider {
        height: calc(100vh - 160px) !important;
    }

    #prevBtn, #nextBtn {
        padding: 0.5rem;
    }

    .slider-dot {
        width: 0.625rem;
        height: 0.625rem;
    }
}

/* Animation for slider content */
.slider-item h1 {
    animation: slideInFromTop 1s ease-out;
}

.slider-item p {
    animation: slideInFromBottom 1s ease-out 0.2s both;
}

.slider-item a {
    animation: fadeIn 1s ease-out 0.4s both;
}

/* Enhanced Marquee Animation */
.marquee-content {
    animation: marquee 30s linear infinite;
}

.marquee-container:hover .marquee-content {
    animation-play-state: paused;
}

@keyframes slideInFromTop {
    0% {
        opacity: 0;
        transform: translateY(-30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInFromBottom {
    0% {
        opacity: 0;
        transform: translateY(30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('heroSlider');
    if (!slider) return;

    const slides = slider.querySelectorAll('.slider-item');
    const dots = slider.querySelectorAll('.slider-dot');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    if (slides.length <= 1) return; // No need for controls if only one slide

    let currentSlide = 0;
    let slideInterval;

    // Initialize slider
    function initSlider() {
        showSlide(0);
        startAutoSlide();
    }

    // Show specific slide
    function showSlide(index) {
        // Hide all slides
        slides.forEach(slide => {
            slide.classList.remove('opacity-100');
            slide.classList.add('opacity-0');
        });

        // Update dots
        dots.forEach(dot => {
            dot.classList.remove('bg-white');
            dot.classList.add('bg-white', 'bg-opacity-50');
        });

        // Show current slide
        if (slides[index]) {
            slides[index].classList.remove('opacity-0');
            slides[index].classList.add('opacity-100');
        }

        // Update current dot
        if (dots[index]) {
            dots[index].classList.remove('bg-opacity-50');
            dots[index].classList.add('bg-white');
        }

        currentSlide = index;
    }

    // Next slide
    function nextSlide() {
        const next = (currentSlide + 1) % slides.length;
        showSlide(next);
    }

    // Previous slide
    function prevSlide() {
        const prev = currentSlide === 0 ? slides.length - 1 : currentSlide - 1;
        showSlide(prev);
    }

    // Auto slide functionality
    function startAutoSlide() {
        slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
    }

    function stopAutoSlide() {
        clearInterval(slideInterval);
    }

    function restartAutoSlide() {
        stopAutoSlide();
        startAutoSlide();
    }

    // Event listeners
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            nextSlide();
            restartAutoSlide();
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            prevSlide();
            restartAutoSlide();
        });
    }

    // Dot navigation
    dots.forEach((dot, index) => {
        dot.addEventListener('click', function() {
            showSlide(index);
            restartAutoSlide();
        });
    });

    // Pause on hover
    slider.addEventListener('mouseenter', stopAutoSlide);
    slider.addEventListener('mouseleave', startAutoSlide);

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
            prevSlide();
            restartAutoSlide();
        } else if (e.key === 'ArrowRight') {
            nextSlide();
            restartAutoSlide();
        }
    });

    // Touch/Swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;

    slider.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    });

    slider.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });

    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;

        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                // Swipe left - next slide
                nextSlide();
            } else {
                // Swipe right - previous slide
                prevSlide();
            }
            restartAutoSlide();
        }
    }

    // Initialize the slider
    initSlider();
});
</script>
@endpush
