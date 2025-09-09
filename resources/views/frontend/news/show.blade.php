@extends('frontend.layouts.app')

@section('title', $news->title . ' - ' . setting('site.title', 'Website Pemerintah'))
@section('description', $news->excerpt ?? Str::limit(strip_tags($news->content), 160))
@section('keywords', $news->tags ? implode(', ', $news->tags) : '')
@section('og_image', $news->featured_image ? Storage::url($news->featured_image) : '')

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center text-white">
            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-white bg-opacity-20 mb-4">
                {{ $news->category->name }}
            </span>
            <h1 class="text-2xl md:text-4xl font-bold mb-4 leading-tight">{{ $news->title }}</h1>
            <div class="flex justify-center items-center space-x-6 text-blue-100">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $news->author->name }}
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $news->published_at->locale('id')->translatedFormat('l, d F Y') }}
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    {{ number_format($news->views_count ?? 0) }} views
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<section class="bg-gray-100 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                <li class="text-gray-900 font-medium">{{ Str::limit($news->title, 50) }}</li>
            </ol>
        </nav>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
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
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
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
                            <span class="inline-block px-3 py-1 text-sm font-medium text-blue-600 bg-blue-100 rounded-full">
                                #{{ $tag }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <!-- Share Buttons -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-900 mb-3">Bagikan:</h3>
                        <div class="flex space-x-4">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                               target="_blank"
                               class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                                Facebook
                            </a>
                            
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($news->title) }}" 
                               target="_blank"
                               class="flex items-center px-4 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                                Twitter
                            </a>
                            
                            <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . url()->current()) }}" 
                               target="_blank"
                               class="flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
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
                   class="flex items-center space-x-2 text-blue-600 hover:text-blue-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
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
                   class="flex items-center space-x-2 text-blue-600 hover:text-blue-700 transition-colors text-right">
                    <div>
                        <div class="text-sm text-gray-500">Selanjutnya</div>
                        <div class="font-medium">{{ Str::limit($nextNews->title, 40) }}</div>
                    </div>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
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
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Berita Terkait</h3>
                <div class="space-y-4">
                    @foreach($relatedNews as $item)
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

            <!-- Back to News -->
            <div class="bg-blue-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Jelajahi Lebih Banyak</h3>
                <div class="space-y-3">
                    <a href="{{ route('news.index') }}" 
                       class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 text-center">
                        Semua Berita
                    </a>
                    <a href="{{ route('news.category', $news->category->slug) }}" 
                       class="block w-full border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white font-medium py-2 px-4 rounded-lg transition-colors duration-300 text-center">
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
        @apply text-gray-900 font-semibold;
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
        @apply border-l-4 border-blue-500 pl-4 italic text-gray-600 bg-blue-50 py-2;
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