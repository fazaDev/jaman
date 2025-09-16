@extends('frontend.layouts.app')

@section('title', 'Agenda Kegiatan - ' . setting('site_name', 'PUPR'))

@section('content')
<!-- Page Header -->
<section class="bg-blue-800 py-12">
    <div class="container mx-auto px-4">
        <div class="text-center text-white">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">Agenda Kegiatan</h1>
            <p class="text-lg text-blue-100">Agenda Kegiatan dari {{ setting('site.title', 'PUPR Provinsi Jambi') }}</p>
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
                <li class="text-blue-800 font-medium">Agenda Kegiatan</li>
            </ol>
        </nav>
    </div>
</section>
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-blue-800 mb-6">Agenda Kegiatan</h1>

        @forelse($agendas as $agenda)
        <div class="border-b border-gray-200 py-4 hover:bg-blue-50 transition-colors duration-200">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <h2 class="text-xl font-semibold text-blue-800 mb-2">
                        <a href="{{ route('agendas.show', $agenda->slug) }}" class="hover:text-yellow-600">
                            {{ $agenda->title }}
                        </a>
                    </h2>
                    <p class="text-gray-600 mb-3">{{ $agenda->description }}</p>
                    <div class="flex flex-wrap items-center text-sm text-gray-500">
                        <span class="mr-4"><i class="far fa-calendar-alt mr-1"></i> {{ $agenda->start_date->format('d M Y H:i') }} WIB</span>
                        @if($agenda->end_date)
                        <span class="mr-4"><i class="far fa-calendar-check mr-1"></i> Selesai: {{ $agenda->end_date->format('d M Y H:i') }} WIB</span>
                        @endif
                        @if($agenda->location)
                        <span class="mr-4"><i class="fas fa-map-marker-alt mr-1"></i> {{ $agenda->location }}</span>
                        @endif
                    </div>
                </div>
                <div class="bg-yellow-400 text-blue-900 rounded-lg w-16 h-16 flex flex-col items-center justify-center text-center ml-4">
                    <span class="font-bold text-xl">{{ $agenda->start_date->format('d') }}</span>
                    <span class="text-xs">{{ strtoupper($agenda->start_date->format('M')) }}</span>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-8">
            <i class="fas fa-calendar-alt text-4xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-medium text-gray-500 mb-2">Tidak ada agenda kegiatan</h3>
            <p class="text-gray-400">Belum ada agenda kegiatan yang dijadwalkan saat ini.</p>
        </div>
        @endforelse

        <!-- Pagination -->
        @if($agendas->hasPages())
        <div class="mt-6">
            {{ $agendas->links() }}
        </div>
        @endif
    </div>
</div>
@endsection