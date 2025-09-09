@extends('frontend.layouts.app')

@section('title', $page->title . ' - ' . setting('site.title', 'Website Pemerintah'))
@section('description', $page->excerpt ?? Str::limit(strip_tags($page->content), 160))

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-purple-600 to-purple-800 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center text-white">
            <h1 class="text-4xl font-bold mb-4">{{ $page->title }}</h1>
            @if($page->excerpt)
            <p class="text-xl text-purple-100">{{ $page->excerpt }}</p>
            @endif
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
                @if($page->parent)
                <li>
                    <a href="{{ route('page.show', $page->parent->slug) }}" class="text-gray-500 hover:text-gray-700">{{ $page->parent->title }}</a>
                </li>
                <li>
                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </li>
                @endif
                <li class="text-gray-900 font-medium">{{ $page->title }}</li>
            </ol>
        </nav>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <div class="lg:w-2/3">
            <article class="bg-white rounded-lg shadow-lg p-8">
                @if($page->featured_image)
                <div class="mb-8">
                    <img src="{{ Storage::url($page->featured_image) }}" 
                         alt="{{ $page->featured_image_alt ?? $page->title }}"
                         class="w-full h-64 md:h-96 object-cover rounded-lg">
                </div>
                @endif
                
                <div class="prose prose-lg max-w-none">
                    {!! $page->content !!}
                </div>
                
                @if($page->updated_at > $page->created_at)
                <div class="mt-8 pt-6 border-t border-gray-200 text-sm text-gray-500">
                    Terakhir diperbarui: {{ $page->updated_at->locale('id')->translatedFormat('l, d F Y H:i') }}
                </div>
                @endif
            </article>
        </div>

        <!-- Sidebar -->
        <div class="lg:w-1/3">
            <!-- Child Pages -->
            @if($childPages->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Halaman Terkait</h3>
                <ul class="space-y-3">
                    @foreach($childPages as $child)
                    <li>
                        <a href="{{ route('page.show', $child->slug) }}" 
                           class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-900">{{ $child->title }}</h4>
                                @if($child->excerpt)
                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($child->excerpt, 80) }}</p>
                                @endif
                            </div>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Quick Links -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Navigasi Cepat</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('news.index') }}" class="text-blue-600 hover:text-blue-700 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                            Berita Terbaru
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gallery.index') }}" class="text-blue-600 hover:text-blue-700 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Galeri
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-blue-600 hover:text-blue-700 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Kontak
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="bg-blue-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Hubungi Kami</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-700">{{ setting('contact.address', 'Jl. Example No. 123, Jakarta, Indonesia') }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                        </svg>
                        <span class="text-gray-700">{{ setting('contact.phone', '021-1234567') }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                        <span class="text-gray-700">{{ setting('contact.email', 'info@example.gov.id') }}</span>
                    </div>
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
        @apply border-l-4 border-purple-500 pl-4 italic text-gray-600 bg-purple-50 py-2;
    }
</style>
@endpush