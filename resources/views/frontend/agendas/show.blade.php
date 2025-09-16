@extends('frontend.layouts.app')

@section('title', $agenda->title . ' - ' . setting('site_name', 'PUPR'))

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <article>
            <header class="mb-6">
                <h1 class="text-3xl font-bold text-blue-800 mb-4">{{ $agenda->title }}</h1>
                
                <div class="flex flex-wrap items-center text-sm text-gray-500 mb-4">
                    <span class="mr-4"><i class="far fa-calendar-alt mr-1"></i> Mulai: {{ $agenda->start_date->format('d M Y H:i') }} WIB</span>
                    @if($agenda->end_date)
                    <span class="mr-4"><i class="far fa-calendar-check mr-1"></i> Selesai: {{ $agenda->end_date->format('d M Y H:i') }} WIB</span>
                    @endif
                    @if($agenda->location)
                    <span class="mr-4"><i class="fas fa-map-marker-alt mr-1"></i> {{ $agenda->location }}</span>
                    @endif
                    <span class="bg-{{ $agenda->status === 'published' ? 'green' : ($agenda->status === 'cancelled' ? 'red' : 'blue') }}-100 text-{{ $agenda->status === 'published' ? 'green' : ($agenda->status === 'cancelled' ? 'red' : 'blue') }}-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                        {{ ucfirst($agenda->status) }}
                    </span>
                    @if($agenda->is_featured)
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded ml-2">Featured</span>
                    @endif
                </div>
            </header>

            @if($agenda->description)
            <div class="prose max-w-none mb-6">
                {!! $agenda->description !!}
            </div>
            @endif

            <div class="bg-blue-50 rounded-lg p-4 mb-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">Detail Kegiatan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600"><strong>Tanggal Mulai:</strong> {{ $agenda->start_date->format('d M Y H:i') }} WIB</p>
                        @if($agenda->end_date)
                        <p class="text-gray-600"><strong>Tanggal Selesai:</strong> {{ $agenda->end_date->format('d M Y H:i') }} WIB</p>
                        @endif
                    </div>
                    @if($agenda->location)
                    <div>
                        <p class="text-gray-600"><strong>Lokasi:</strong> {{ $agenda->location }}</p>
                    </div>
                    @endif
                </div>
            </div>

            @if($agenda->meta_keywords)
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">Tags:</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach(explode(',', $agenda->meta_keywords) as $keyword)
                    <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded">
                        {{ trim($keyword) }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif
        </article>

        <div class="mt-8 pt-6 border-t border-gray-200">
            <a href="{{ route('agendas.index') }}" class="inline-flex items-center text-blue-800 hover:text-yellow-600">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke daftar agenda
            </a>
        </div>
    </div>
</div>
@endsection