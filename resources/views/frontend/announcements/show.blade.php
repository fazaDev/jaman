@extends('frontend.layouts.app')

@section('title', $announcement->title . ' - ' . setting('site_name', 'PUPR'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <article>
            <header class="mb-6">
                <h1 class="text-3xl font-bold text-blue-800 mb-4">{{ $announcement->title }}</h1>
                
                <div class="flex flex-wrap items-center text-sm text-gray-500 mb-4">
                    <span class="mr-4"><i class="far fa-calendar-alt mr-1"></i> Dipublikasikan: {{ $announcement->published_at->format('d M Y H:i') }}</span>
                    <span class="mr-4"><i class="far fa-eye mr-1"></i> {{ $announcement->views_count }} views</span>
                    @if($announcement->expires_at)
                    <span class="mr-4"><i class="far fa-clock mr-1"></i> Berlaku hingga: {{ $announcement->expires_at->format('d M Y') }}</span>
                    @endif
                    @if($announcement->is_featured)
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded">Featured</span>
                    @endif
                </div>
            </header>

            <div class="prose max-w-none">
                {!! $announcement->content !!}
            </div>

            @if($announcement->meta_keywords)
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">Tags:</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach(explode(',', $announcement->meta_keywords) as $keyword)
                    <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded">
                        {{ trim($keyword) }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif
        </article>

        <div class="mt-8 pt-6 border-t border-gray-200">
            <a href="{{ route('announcements.index') }}" class="inline-flex items-center text-blue-800 hover:text-yellow-600">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke daftar pengumuman
            </a>
        </div>
    </div>
</div>
@endsection