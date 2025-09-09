@extends('frontend.layouts.app')

@section('title', $category->name . ' - Berita - ' . setting('site.title', 'Website Pemerintah'))
@section('description', 'Berita kategori ' . $category->name . ' dari ' . setting('site.title', 'Website Pemerintah'))

@section('content')
<!-- Page Header -->
<section class="bg-blue-800 py-12">
    <div class="container mx-auto px-4">
        <div class="text-center text-white">
            <div class="flex items-center justify-center mb-4">
                <div class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $category->color }}"></div>
                <h1 class="text-3xl md:text-4xl font-bold">{{ $category->name }}</h1>
            </div>
            @if($category->description)
            <p class="text-lg text-blue-100">{{ $category->description }}</p>
            @else
            <p class="text-lg text-blue-100">Berita kategori {{ $category->name }}</p>
            @endif
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
                <li>
                    <a href="{{ route('news.index') }}" class="text-gray-500 hover:text-gray-700">Berita</a>
                </li>
                <li>
                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </li>
                <li class="text-blue-800 font-medium">{{ $category->name }}</li>
            </ol>
        </nav>
    </div>
</section>

<div class="container mx-auto px-4 py-12">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <div class="lg:w-2/3">
            @if(isset($news) && $news->count() > 0)
            <div class="space-y-6">
                @foreach($news as $item)
                <article class="flex flex-col sm:flex-row bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    @if($item->featured_image)
                    <div class="sm:w-1/3">
                        <img src="{{ Storage::url($item->featured_image) }}"
                             alt="{{ $item->featured_image_alt ?? $item->title }}"
                             class="w-full h-48 sm:h-full object-cover">
                    </div>
                    @endif

                    <div class="p-6 flex-1">
                        <div class="flex items-center mb-3">
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full"
                                  style="background-color: {{ $item->category->color }}20; color: {{ $item->category->color }}">
                                {{ $item->category->name }}
                            </span>
                            <span class="text-gray-500 text-sm ml-auto">
                                {{ $item->published_at->format('d F Y') }} • {{ $item->published_at->diffForHumans() }}
                            </span>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-900 mb-3 hover:text-blue-600 transition-colors">
                            <a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a>
                        </h3>

                        @if($item->excerpt)
                        <p class="text-gray-600 mb-4 line-clamp-2">{{ $item->excerpt }}</p>
                        @endif

                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $item->author->name }}
                                <span class="mx-2">•</span>
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                {{ number_format($item->views_count ?? 0) }} views
                            </div>

                            <a href="{{ route('news.show', $item->slug) }}"
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
                <p class="text-gray-600">Berita kategori {{ $category->name }} akan ditampilkan di sini ketika sudah tersedia.</p>
                <div class="mt-6">
                    <a href="{{ route('news.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-300">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke Semua Berita
                    </a>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:w-1/3">
            <!-- Back to All News -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Navigasi</h3>
                <div class="space-y-3">
                    <a href="{{ route('news.index') }}"
                       class="flex items-center text-blue-600 hover:text-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Semua Berita
                    </a>
                </div>
            </div>

            <!-- Categories -->
            @if(isset($categories) && $categories->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Kategori Lainnya</h3>
                <ul class="space-y-2">
                    @foreach($categories as $cat)
                    @if($cat->id !== $category->id)
                    <li>
                        <a href="{{ route('news.category', $cat->slug) }}"
                           class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex items-center">
                                <div class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $cat->color }}"></div>
                                <span class="text-gray-700">{{ $cat->name }}</span>
                            </div>
                            <span class="text-gray-500 text-sm">{{ $cat->news_count ?? 0 }}</span>
                        </a>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Popular News -->
            @if(isset($popularNews) && $popularNews->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Berita Populer</h3>
                <div class="space-y-4">
                    @foreach($popularNews as $item)
                    <article class="flex space-x-3">
                        @if($item->featured_image)
                        <img src="{{ Storage::url($item->featured_image) }}"
                             alt="{{ $item->title }}"
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
                                <a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a>
                            </h4>
                            <p class="text-xs text-gray-500 mt-1">{{ $item->published_at->diffForHumans() }}</p>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Search -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Cari Berita</h3>
                <form method="GET" action="{{ route('news.index') }}">
                    <div class="relative">
                        <input type="search"
                               name="search"
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
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
