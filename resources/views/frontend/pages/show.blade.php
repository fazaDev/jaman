@extends('frontend.layouts.app')

@section('title', $page->title . ' - ' . setting('site.title', 'Website Pemerintah'))
@section('description', $page->excerpt ?? Str::limit(strip_tags($page->content), 160))

@section('content')
<!-- Page Header -->
<section class="bg-blue-800 py-12">
    <div class="container mx-auto px-4">
        <div class="text-center text-white">
            <h1 class="text-3xl md:text-4xl font-bold mb-4 flex items-center justify-center">
                <i class="fas fa-file-alt text-yellow-400 mr-3"></i>
                {{ $page->title }}
            </h1>
            @if($page->excerpt)
            <p class="text-lg text-blue-100">{{ $page->excerpt }}</p>
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
                <li class="text-blue-800 font-medium">{{ $page->title }}</li>
            </ol>
        </nav>
    </div>
</section>

<div class="container mx-auto px-4 py-12">
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
                <h3 class="text-lg font-semibold text-blue-800 mb-4 flex items-center">
                    <i class="fas fa-sitemap text-yellow-400 mr-2"></i>
                    Halaman Terkait
                </h3>
                <ul class="space-y-3">
                    @foreach($childPages as $child)
                    <li>
                        <a href="{{ route('page.show', $child->slug) }}"
                           class="flex items-center p-3 rounded-lg hover:bg-blue-50 transition-colors group">
                            <div class="flex-1">
                                <h4 class="font-medium text-blue-800 group-hover:text-yellow-600">{{ $child->title }}</h4>
                                @if($child->excerpt)
                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($child->excerpt, 80) }}</p>
                                @endif
                            </div>
                            <i class="fas fa-chevron-right text-gray-400 group-hover:text-yellow-600"></i>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Quick Links -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-4 flex items-center">
                    <i class="fas fa-link text-yellow-400 mr-2"></i>
                    Navigasi Cepat
                </h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}" class="text-blue-600 hover:text-yellow-600 flex items-center group transition-colors">
                            <i class="fas fa-home w-4 h-4 mr-2 group-hover:text-yellow-600"></i>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('news.index') }}" class="text-blue-600 hover:text-yellow-600 flex items-center group transition-colors">
                            <i class="fas fa-newspaper w-4 h-4 mr-2 group-hover:text-yellow-600"></i>
                            Berita Terbaru
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gallery.index') }}" class="text-blue-600 hover:text-yellow-600 flex items-center group transition-colors">
                            <i class="fas fa-images w-4 h-4 mr-2 group-hover:text-yellow-600"></i>
                            Galeri
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-blue-600 hover:text-yellow-600 flex items-center group transition-colors">
                            <i class="fas fa-envelope w-4 h-4 mr-2 group-hover:text-yellow-600"></i>
                            Kontak
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="bg-blue-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-4 flex items-center">
                    <i class="fas fa-phone text-yellow-400 mr-2"></i>
                    Hubungi Kami
                </h3>
                <div class="space-y-3 text-sm">
                    <div class="flex items-start">
                        <i class="fas fa-map-marker-alt text-blue-600 mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-gray-700">{{ setting('contact.address', 'Jl. Example No. 123, Jakarta, Indonesia') }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-phone text-blue-600 mr-2"></i>
                        <span class="text-gray-700">{{ setting('contact.phone', '021-1234567') }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-envelope text-blue-600 mr-2"></i>
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
</style>
@endpush
