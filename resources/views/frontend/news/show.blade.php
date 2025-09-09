@extends('frontend.layouts.app')

@section('title', $news->title . ' - ' . setting('site.title', 'Website Pemerintah'))
@section('description', $news->excerpt ?? Str::limit(strip_tags($news->content), 160))
@section('keywords', $news->tags ? implode(', ', $news->tags) : '')
@section('og_image', $news->featured_image ? Storage::url($news->featured_image) : '')

@section('content')
<!-- Page Header -->
<section class="bg-blue-800 py-12">
    <div class="container mx-auto px-4">
        <div class="text-center text-white">
            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-yellow-400 text-blue-800 mb-4">
                {{ $news->category->name }}
            </span>
            <h1 class="text-2xl md:text-4xl font-bold mb-4 leading-tight">{{ $news->title }}</h1>
            <div class="flex justify-center items-center space-x-6 text-blue-100">
                <div class="flex items-center">
                    <i class="fas fa-user mr-2"></i>
                    {{ $news->author->name }}
                </div>
                <div class="flex items-center">
                    <i class="fas fa-clock mr-2"></i>
                    {{ $news->published_at->locale('id')->translatedFormat('l, d F Y') }}
                </div>
                <div class="flex items-center">
                    <i class="fas fa-eye mr-2"></i>
                    {{ number_format($news->views_count ?? 0) }} views
                </div>
            </div>
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
                <li>
                    <a href="{{ route('news.category', $news->category->slug) }}" class="text-gray-500 hover:text-gray-700">{{ $news->category->name }}</a>
                </li>
                <li>
                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </li>
                <li class="text-blue-800 font-medium">{{ Str::limit($news->title, 50) }}</li>
            </ol>
        </nav>
    </div>
</section>

<div class="container mx-auto px-4 py-12">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <article class="lg:w-2/3">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Featured Image -->
                @if($news->featured_image)
                <div class="aspect-w-16 aspect-h-9">
                    <img src="{{ Storage::url($news->featured_image) }}"
                         alt="{{ $news->featured_image_alt ?? $news->title }}"
                         class="w-full h-64 md:h-96 object-cover">
                </div>
                @endif

                <div class="p-6 md:p-8">
                    <!-- Excerpt -->
                    @if($news->excerpt)
                    <div class="bg-blue-50 border-l-4 border-blue-800 p-4 mb-6">
                        <p class="text-lg text-blue-800 font-medium">{{ $news->excerpt }}</p>
                    </div>
                    @endif

                    <!-- Content -->
                    <div class="prose prose-lg max-w-none">
                        {!! $news->content !!}
                    </div>

                    <!-- Tags -->
                    @if($news->tags && count($news->tags) > 0)
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3">Tags:</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($news->tags as $tag)
                            <span class="inline-block px-3 py-1 text-sm font-medium text-blue-800 bg-yellow-100 rounded-full">
                                #{{ $tag }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Share Buttons -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-sm font-semibold text-blue-800 mb-3 flex items-center">
                            <i class="fas fa-share-alt text-yellow-400 mr-2"></i>
                            Bagikan:
                        </h3>
                        <div class="flex space-x-4">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                               target="_blank"
                               class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fab fa-facebook-f mr-2"></i>
                                Facebook
                            </a>

                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($news->title) }}"
                               target="_blank"
                               class="flex items-center px-4 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600 transition-colors">
                                <i class="fab fa-twitter mr-2"></i>
                                Twitter
                            </a>

                            <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . url()->current()) }}"
                               target="_blank"
                               class="flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                <i class="fab fa-whatsapp mr-2"></i>
                                WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="mt-8 flex justify-between">
                @if($previousNews)
                <a href="{{ route('news.show', $previousNews->slug) }}"
                   class="flex items-center space-x-2 text-blue-600 hover:text-yellow-600 transition-colors group">
                    <i class="fas fa-chevron-left text-blue-600 group-hover:text-yellow-600"></i>
                    <div>
                        <div class="text-sm text-gray-500">Sebelumnya</div>
                        <div class="font-medium">{{ Str::limit($previousNews->title, 40) }}</div>
                    </div>
                </a>
                @else
                <div></div>
                @endif

                @if($nextNews)
                <a href="{{ route('news.show', $nextNews->slug) }}"
                   class="flex items-center space-x-2 text-blue-600 hover:text-yellow-600 transition-colors text-right group">
                    <div>
                        <div class="text-sm text-gray-500">Selanjutnya</div>
                        <div class="font-medium">{{ Str::limit($nextNews->title, 40) }}</div>
                    </div>
                    <i class="fas fa-chevron-right text-blue-600 group-hover:text-yellow-600"></i>
                </a>
                @else
                <div></div>
                @endif
            </div>
        </article>

        <!-- Sidebar -->
        <div class="lg:w-1/3">
            <!-- Related News -->
            @if(isset($relatedNews) && $relatedNews->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-4 flex items-center">
                    <i class="fas fa-newspaper text-yellow-400 mr-2"></i>
                    Berita Terkait
                </h3>
                <div class="space-y-4">
                    @foreach($relatedNews as $item)
                    <article class="flex space-x-3">
                        @if($item->featured_image)
                        <img src="{{ Storage::url($item->featured_image) }}"
                             alt="{{ $item->title }}"
                             class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
                        @else
                        <div class="w-16 h-16 bg-blue-100 rounded-lg flex-shrink-0 flex items-center justify-center">
                            <i class="fas fa-newspaper text-blue-800"></i>
                        </div>
                        @endif

                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-medium text-blue-800 line-clamp-2 hover:text-yellow-600 transition-colors">
                                <a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a>
                            </h4>
                            <p class="text-xs text-gray-500 mt-1">{{ $item->published_at->diffForHumans() }}</p>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Popular News -->
            @if(isset($popularNews) && $popularNews->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-4 flex items-center">
                    <i class="fas fa-fire text-yellow-400 mr-2"></i>
                    Berita Populer
                </h3>
                <div class="space-y-4">
                    @foreach($popularNews as $item)
                    <article class="flex space-x-3">
                        @if($item->featured_image)
                        <img src="{{ Storage::url($item->featured_image) }}"
                             alt="{{ $item->title }}"
                             class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
                        @else
                        <div class="w-16 h-16 bg-blue-100 rounded-lg flex-shrink-0 flex items-center justify-center">
                            <i class="fas fa-newspaper text-blue-800"></i>
                        </div>
                        @endif

                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-medium text-blue-800 line-clamp-2 hover:text-yellow-600 transition-colors">
                                <a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a>
                            </h4>
                            <p class="text-xs text-gray-500 mt-1">{{ $item->published_at->diffForHumans() }}</p>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Back to News -->
            <div class="bg-blue-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-4 flex items-center">
                    <i class="fas fa-compass text-yellow-400 mr-2"></i>
                    Jelajahi Lebih Banyak
                </h3>
                <div class="space-y-3">
                    <a href="{{ route('news.index') }}"
                       class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 text-center flex items-center justify-center">
                        <i class="fas fa-list mr-2"></i>
                        Semua Berita
                    </a>
                    <a href="{{ route('news.category', $news->category->slug) }}"
                       class="block w-full border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 text-center flex items-center justify-center">
                        <i class="fas fa-folder mr-2"></i>
                        Kategori {{ $news->category->name }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .prose {
        @apply text-gray-700;
    }
    .prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
        @apply text-blue-800 font-semibold;
    }
    .prose p {
        @apply mb-4;
    }
    .prose ul, .prose ol {
        @apply mb-4;
    }
    .prose img {
        @apply rounded-lg shadow-md;
    }
    .prose blockquote {
        @apply border-l-4 border-blue-800 pl-4 italic text-gray-600 bg-blue-50 py-2;
    }
    .prose a {
        @apply text-blue-600 hover:text-yellow-600 transition-colors;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
