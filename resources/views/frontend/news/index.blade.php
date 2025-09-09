@extends('frontend.layouts.app')

@section('title', 'Berita - ' . setting('site.title', 'PUPR Provinsi Jambi'))
@section('description', 'Berita terbaru dan informasi penting dari ' . setting('site.title', 'PUPR Provinsi Jambi'))

@section('content')
<!-- Page Header -->
<section class="bg-blue-800 py-12">
    <div class="container mx-auto px-4">
        <div class="text-center text-white">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">Berita Terkini</h1>
            <p class="text-lg text-blue-100">Informasi terbaru dan terpenting dari {{ setting('site.title', 'PUPR Provinsi Jambi') }}</p>
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
                <li class="text-blue-800 font-medium">Berita</li>
            </ol>
        </nav>
    </div>
</section>

<div class="container mx-auto px-4 py-12">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <div class="lg:w-2/3">
            <!-- Featured News -->
            @if(isset($featuredNews) && $featuredNews->count() > 0)
            <section class="mb-12">
                <h2 class="text-2xl font-bold text-blue-800 mb-6 flex items-center">
                    <i class="fas fa-star text-yellow-400 mr-2"></i>
                    Berita Unggulan
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($featuredNews as $featuredItem)
                    <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 news-card">
                        @if($featuredItem->featured_image)
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="{{ Storage::url($featuredItem->featured_image) }}"
                                 alt="{{ $featuredItem->featured_image_alt ?? $featuredItem->title }}"
                                 class="w-full h-48 object-cover">
                        </div>
                        @endif

                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-blue-800">
                                    {{ $featuredItem->category->name }}
                                </span>
                                <span class="text-gray-500 text-sm ml-auto">
                                    {{ $featuredItem->published_at->locale('id')->diffForHumans() }}
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-blue-800 mb-3 hover:text-yellow-600 transition-colors">
                                <a href="{{ route('news.show', $featuredItem->slug) }}">{{ $featuredItem->title }}</a>
                            </h3>

                            @if($featuredItem->excerpt)
                            <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($featuredItem->excerpt, 120) }}</p>
                            @endif

                            <a href="{{ route('news.show', $featuredItem->slug) }}"
                               class="text-blue-800 hover:text-yellow-600 font-medium text-sm flex items-center">
                                Baca Selengkapnya
                                <i class="fas fa-arrow-right ml-2 text-xs"></i>
                            </a>
                        </div>
                    </article>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- All News -->
            <section>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-blue-800 flex items-center">
                        <i class="fas fa-newspaper mr-2"></i>
                        Semua Berita
                    </h2>

                    <!-- Sort Options -->
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">Urutkan:</span>
                        <select class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="latest">Terbaru</option>
                            <option value="oldest">Terlama</option>
                            <option value="popular">Terpopuler</option>
                        </select>
                    </div>
                </div>

                @if(isset($news) && $news->count() > 0)
                <div class="space-y-6">
                    @foreach($news as $newsItem)
                    <article class="flex flex-col sm:flex-row bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 news-card">
                        @if($newsItem->featured_image)
                        <div class="sm:w-1/3">
                            <img src="{{ Storage::url($newsItem->featured_image) }}"
                                 alt="{{ $newsItem->featured_image_alt ?? $newsItem->title }}"
                                 class="w-full h-48 sm:h-full object-cover">
                        </div>
                        @endif

                        <div class="p-6 flex-1">
                            <div class="flex items-center mb-3">
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-blue-800">
                                    {{ $newsItem->category->name }}
                                </span>
                                <span class="text-gray-500 text-sm ml-auto">
                                    {{ $newsItem->published_at->locale('id')->format('d F Y') }} • {{ $newsItem->published_at->locale('id')->diffForHumans() }}
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-blue-800 mb-3 hover:text-yellow-600 transition-colors">
                                <a href="{{ route('news.show', $newsItem->slug) }}">{{ $newsItem->title }}</a>
                            </h3>

                            @if($newsItem->excerpt)
                            <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($newsItem->excerpt, 150) }}</p>
                            @endif

                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-user mr-1"></i>
                                    {{ $newsItem->author->name }}
                                    <span class="mx-2">•</span>
                                    <i class="fas fa-eye mr-1"></i>
                                    {{ number_format($newsItem->views_count ?? 0) }} views
                                </div>

                                <a href="{{ route('news.show', $newsItem->slug) }}"
                                   class="text-blue-800 hover:text-yellow-600 font-medium text-sm flex items-center">
                                    Baca Selengkapnya
                                    <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $news->links() }}
                </div>
                @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada berita</h3>
                    <p class="text-gray-600">Berita akan ditampilkan di sini ketika sudah tersedia.</p>
                </div>
                @endif
            </section>
        </div>

        <!-- Sidebar -->
        <div class="lg:w-1/3">
            <!-- Search -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Cari Berita</h3>
                <form method="GET" action="{{ route('news.index') }}">
                    <div class="relative">
                        <input type="search"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari berita..."
                               class="w-full px-4 py-2 pl-10 pr-4 text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <button type="submit" class="w-full mt-3 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300">
                        Cari
                    </button>
                </form>
            </div>

            <!-- Categories -->
            @if(isset($categories) && $categories->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Kategori</h3>
                <ul class="space-y-2">
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ route('news.category', $category->slug) }}"
                           class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex items-center">
                                <div class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $category->color }}"></div>
                                <span class="text-gray-700">{{ $category->name }}</span>
                            </div>
                            <span class="text-gray-500 text-sm">{{ $category->news_count ?? 0 }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Popular News -->
            @if(isset($popularNews) && $popularNews->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Berita Populer</h3>
                <div class="space-y-4">
                    @foreach($popularNews as $popularItem)
                    <article class="flex space-x-3">
                        @if($popularItem->featured_image)
                        <img src="{{ Storage::url($popularItem->featured_image) }}"
                             alt="{{ $popularItem->title }}"
                             class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
                        @else
                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex-shrink-0 flex items-center justify-center">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        @endif

                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-medium text-gray-900 line-clamp-2 hover:text-blue-600 transition-colors">
                                <a href="{{ route('news.show', $popularItem->slug) }}">{{ $popularItem->title }}</a>
                            </h4>
                            <p class="text-xs text-gray-500 mt-1">{{ $popularItem->published_at->diffForHumans() }}</p>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Archives -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Arsip</h3>
                <ul class="space-y-2">
                    @for($i = 0; $i < 6; $i++)
                    @php
                        $date = now()->subMonths($i);
                    @endphp
                    <li>
                        <a href="{{ route('news.index', ['month' => $date->month, 'year' => $date->year]) }}"
                           class="block py-2 px-3 rounded-lg hover:bg-gray-50 transition-colors text-gray-700">
                            {{ $date->locale('id')->translatedFormat('F Y') }}
                        </a>
                    </li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
