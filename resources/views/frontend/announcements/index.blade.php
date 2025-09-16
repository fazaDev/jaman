@extends('frontend.layouts.app')

@section('title', 'Pengumuman - ' . setting('site_name', 'PUPR'))

@section('content')
<!-- Page Header -->
<section class="bg-blue-800 py-12">
    <div class="container mx-auto px-4">
        <div class="text-center text-white">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">Pengumuman</h1>
            <p class="text-lg text-blue-100">Pengumuman terbaru dan terpenting dari {{ setting('site.title', 'PUPR Provinsi Jambi') }}</p>
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
                <li class="text-blue-800 font-medium">Pengumuman</li>
            </ol>
        </nav>
    </div>
</section>
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-blue-800 mb-6">Pengumuman</h1>

        @forelse($announcements as $announcement)
        <div class="border-b border-gray-200 py-4 hover:bg-blue-50 transition-colors duration-200">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <h2 class="text-xl font-semibold text-blue-800 mb-2">
                        <a href="{{ route('announcements.show', $announcement->slug) }}" class="hover:text-yellow-600">
                            {{ $announcement->title }}
                        </a>
                    </h2>
                    <p class="text-gray-600 mb-3">{{ Str::limit($announcement->excerpt ?? $announcement->content, 150) }}</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <span class="mr-4"><i class="far fa-calendar-alt mr-1"></i> {{ $announcement->published_at->format('d M Y') }}</span>
                        <span><i class="far fa-eye mr-1"></i> {{ $announcement->views_count }} views</span>
                    </div>
                </div>
                @if($announcement->is_featured)
                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded ml-4">Featured</span>
                @endif
            </div>
        </div>
        @empty
        <div class="text-center py-8">
            <i class="fas fa-bullhorn text-4xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-medium text-gray-500 mb-2">Tidak ada pengumuman</h3>
            <p class="text-gray-400">Belum ada pengumuman yang dipublikasikan saat ini.</p>
        </div>
        @endforelse

        <!-- Pagination -->
        @if($announcements->hasPages())
        <div class="mt-6">
            {{ $announcements->links() }}
        </div>
        @endif
    </div>
</div>
@endsection