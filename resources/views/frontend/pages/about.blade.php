@extends('frontend.layouts.app')

@section('title', 'Tentang Kami - ' . setting('site.title', 'Website Pemerintah'))
@section('description', $page ? $page->excerpt ?? Str::limit(strip_tags($page->content), 160) : 'Informasi tentang ' . setting('site.title', 'Website Pemerintah'))

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center text-white">
            <h1 class="text-4xl font-bold mb-4">Tentang Kami</h1>
            <p class="text-xl text-blue-100">Mengenal lebih dekat {{ setting('site.title', 'Website Pemerintah') }}</p>
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
                <li class="text-gray-900 font-medium">Tentang Kami</li>
            </ol>
        </nav>
    </div>
</section>

@if($page)
<!-- Content from CMS -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        @if($page->featured_image)
        <div class="h-64 md:h-96 overflow-hidden">
            <img src="{{ Storage::url($page->featured_image) }}" 
                 alt="{{ $page->featured_image_alt ?? $page->title }}"
                 class="w-full h-full object-cover">
        </div>
        @endif
        
        <div class="p-8 md:p-12">
            @if($page->excerpt)
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mb-8">
                <p class="text-lg text-blue-800 font-medium">{{ $page->excerpt }}</p>
            </div>
            @endif
            
            <div class="prose prose-lg max-w-none">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</div>
@else
<!-- Default About Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Mission Vision -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Visi</h2>
            </div>
            <p class="text-gray-600 text-center leading-relaxed">
                {{ setting('about.vision', 'Menjadi institusi pemerintah yang terdepan dalam memberikan pelayanan terbaik kepada masyarakat dengan mengutamakan transparansi, akuntabilitas, dan inovasi.') }}
            </p>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Misi</h2>
            </div>
            <ul class="text-gray-600 space-y-3">
                <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Memberikan pelayanan publik yang berkualitas dan mudah diakses
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Meningkatkan transparansi dan akuntabilitas dalam penyelenggaraan pemerintahan
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Mengembangkan inovasi dalam pelayanan berbasis teknologi
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Memberdayakan masyarakat dalam pembangunan daerah
                </li>
            </ul>
        </div>
    </div>

    <!-- Values -->
    <div class="bg-white rounded-lg shadow-lg p-8 mb-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Nilai-Nilai Kami</h2>
            <p class="text-lg text-gray-600">Prinsip yang menjadi landasan dalam setiap tindakan kami</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Integritas</h3>
                <p class="text-gray-600 text-sm">Berkomitmen pada kejujuran dan konsistensi dalam setiap tindakan</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Profesional</h3>
                <p class="text-gray-600 text-sm">Memberikan pelayanan dengan standar kualitas terbaik</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-yellow-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Inovatif</h3>
                <p class="text-gray-600 text-sm">Terus mengembangkan solusi kreatif untuk kemajuan bersama</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Peduli</h3>
                <p class="text-gray-600 text-sm">Mengutamakan kepentingan masyarakat dalam setiap kebijakan</p>
            </div>
        </div>
    </div>

    <!-- Organization Structure -->
    <div class="bg-white rounded-lg shadow-lg p-8 mb-16">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Struktur Organisasi</h2>
            <p class="text-lg text-gray-600">Susunan kepemimpinan dan tim kerja kami</p>
        </div>
        
        <!-- Leadership -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="text-center">
                <div class="w-32 h-32 bg-gray-300 rounded-full mx-auto mb-4 overflow-hidden">
                    <img src="{{ asset('images/placeholder-person.jpg') }}" alt="Pimpinan" class="w-full h-full object-cover">
                </div>
                <h3 class="text-lg font-semibold text-gray-900">{{ setting('leadership.head_name', 'Dr. John Doe, M.Si') }}</h3>
                <p class="text-blue-600 font-medium">{{ setting('leadership.head_title', 'Kepala Dinas') }}</p>
                <p class="text-gray-600 text-sm mt-2">{{ setting('leadership.head_description', 'Memimpin organisasi dengan dedikasi tinggi untuk pelayanan masyarakat') }}</p>
            </div>
            
            <div class="text-center">
                <div class="w-32 h-32 bg-gray-300 rounded-full mx-auto mb-4 overflow-hidden">
                    <img src="{{ asset('images/placeholder-person.jpg') }}" alt="Wakil" class="w-full h-full object-cover">
                </div>
                <h3 class="text-lg font-semibold text-gray-900">{{ setting('leadership.deputy_name', 'Jane Smith, S.T., M.M') }}</h3>
                <p class="text-blue-600 font-medium">{{ setting('leadership.deputy_title', 'Wakil Kepala Dinas') }}</p>
                <p class="text-gray-600 text-sm mt-2">{{ setting('leadership.deputy_description', 'Mendukung kepemimpinan dalam mengimplementasikan program kerja') }}</p>
            </div>
            
            <div class="text-center">
                <div class="w-32 h-32 bg-gray-300 rounded-full mx-auto mb-4 overflow-hidden">
                    <img src="{{ asset('images/placeholder-person.jpg') }}" alt="Sekretaris" class="w-full h-full object-cover">
                </div>
                <h3 class="text-lg font-semibold text-gray-900">{{ setting('leadership.secretary_name', 'Ahmad Rahman, S.Sos') }}</h3>
                <p class="text-blue-600 font-medium">{{ setting('leadership.secretary_title', 'Sekretaris Dinas') }}</p>
                <p class="text-gray-600 text-sm mt-2">{{ setting('leadership.secretary_description', 'Mengelola administrasi dan koordinasi internal organisasi') }}</p>
            </div>
        </div>
    </div>

    <!-- Contact CTA -->
    <div class="bg-blue-600 rounded-lg p-8 text-center text-white">
        <h2 class="text-2xl font-bold mb-4">Ingin Mengetahui Lebih Lanjut?</h2>
        <p class="text-blue-100 mb-6">Jangan ragu untuk menghubungi kami. Tim kami siap membantu Anda.</p>
        <a href="{{ route('contact') }}" 
           class="inline-flex items-center px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors duration-300">
            Hubungi Kami
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
            </svg>
        </a>
    </div>
</div>
@endif
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
</style>
@endpush