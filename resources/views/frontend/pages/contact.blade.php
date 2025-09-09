@extends('frontend.layouts.app')

@section('title', 'Kontak - ' . setting('site.title', 'Website Pemerintah'))
@section('description', 'Hubungi kami untuk informasi lebih lanjut tentang layanan ' . setting('site.title', 'Website Pemerintah'))

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-red-600 to-red-800 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center text-white">
            <h1 class="text-4xl font-bold mb-4">Kontak Kami</h1>
            <p class="text-xl text-red-100">Kami siap membantu dan melayani Anda</p>
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
                <li class="text-gray-900 font-medium">Kontak</li>
            </ol>
        </nav>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Content from CMS (if exists) -->
    @if($page && $page->content)
    <div class="bg-white rounded-lg shadow-lg p-8 mb-12">
        <div class="prose prose-lg max-w-none">
            {!! $page->content !!}
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Contact Information -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Informasi Kontak</h2>
            
            <div class="space-y-6">
                <!-- Address -->
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Alamat</h3>
                        <p class="text-gray-600">{{ setting('contact.address', 'Jl. Example No. 123, Jakarta, Indonesia 12345') }}</p>
                    </div>
                </div>

                <!-- Phone -->
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Telepon</h3>
                        <p class="text-gray-600">{{ setting('contact.phone', '021-1234567') }}</p>
                        @if(setting('contact.phone2'))
                        <p class="text-gray-600">{{ setting('contact.phone2') }}</p>
                        @endif
                    </div>
                </div>

                <!-- Email -->
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Email</h3>
                        <p class="text-gray-600">{{ setting('contact.email', 'info@example.gov.id') }}</p>
                        @if(setting('contact.email2'))
                        <p class="text-gray-600">{{ setting('contact.email2') }}</p>
                        @endif
                    </div>
                </div>

                <!-- Office Hours -->
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Jam Operasional</h3>
                        <div class="text-gray-600 space-y-1">
                            <p>Senin - Jumat: {{ setting('contact.office_hours_weekday', '08:00 - 16:00 WIB') }}</p>
                            <p>Sabtu: {{ setting('contact.office_hours_saturday', '08:00 - 12:00 WIB') }}</p>
                            <p>Minggu: {{ setting('contact.office_hours_sunday', 'Tutup') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="mt-8 pt-8 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Ikuti Kami</h3>
                <div class="flex space-x-4">
                    @if(setting('social.facebook'))
                    <a href="{{ setting('social.facebook') }}" target="_blank" 
                       class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white hover:bg-blue-700 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    @endif
                    
                    @if(setting('social.twitter'))
                    <a href="{{ setting('social.twitter') }}" target="_blank" 
                       class="w-10 h-10 bg-sky-500 rounded-lg flex items-center justify-center text-white hover:bg-sky-600 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                    @endif
                    
                    @if(setting('social.instagram'))
                    <a href="{{ setting('social.instagram') }}" target="_blank" 
                       class="w-10 h-10 bg-pink-600 rounded-lg flex items-center justify-center text-white hover:bg-pink-700 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C3.182 14.498 2.8 12.999 2.8 11.4c0-1.599.382-3.098 1.326-4.291.875-.807 2.026-1.297 3.323-1.297 1.297 0 2.448.49 3.323 1.297.944 1.193 1.326 2.692 1.326 4.291 0 1.599-.382 3.098-1.326 4.291-.875.807-2.026 1.297-3.323 1.297zm11.104-1.297c-.875.807-2.026 1.297-3.323 1.297-1.297 0-2.448-.49-3.323-1.297-.944-1.193-1.326-2.692-1.326-4.291 0-1.599.382-3.098 1.326-4.291.875-.807 2.026-1.297 3.323-1.297 1.297 0 2.448.49 3.323 1.297.944 1.193 1.326 2.692 1.326 4.291 0 1.599-.382 3.098-1.326 4.291z"/>
                        </svg>
                    </a>
                    @endif
                    
                    @if(setting('social.youtube'))
                    <a href="{{ setting('social.youtube') }}" target="_blank" 
                       class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center text-white hover:bg-red-700 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Kirim Pesan</h2>
            
            <form action="#" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Depan</label>
                        <input type="text" id="first_name" name="first_name" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Belakang</label>
                        <input type="text" id="last_name" name="last_name" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                    <input type="tel" id="phone" name="phone"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subjek</label>
                    <select id="subject" name="subject" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Pilih Subjek</option>
                        <option value="informasi_umum">Informasi Umum</option>
                        <option value="layanan_publik">Layanan Publik</option>
                        <option value="pengaduan">Pengaduan</option>
                        <option value="kerjasama">Kerjasama</option>
                        <option value="media">Media & Pers</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
                
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                    <textarea id="message" name="message" rows="6" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="Tuliskan pesan Anda di sini..."></textarea>
                </div>
                
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="privacy" name="privacy" type="checkbox" required
                               class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="privacy" class="text-gray-700">
                            Saya setuju dengan <a href="#" class="text-blue-600 hover:text-blue-700">kebijakan privasi</a> dan <a href="#" class="text-blue-600 hover:text-blue-700">syarat & ketentuan</a>
                        </label>
                    </div>
                </div>
                
                <div>
                    <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-300 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Kirim Pesan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Map Section -->
    @if(setting('contact.map_embed'))
    <div class="mt-16">
        <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Lokasi Kami</h2>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="h-96">
                {!! setting('contact.map_embed') !!}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form submission handling
    const contactForm = document.querySelector('form');
    
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Mengirim...';
        submitBtn.disabled = true;
        
        // Simulate form submission (replace with actual submission logic)
        setTimeout(() => {
            alert('Pesan Anda telah terkirim. Terima kasih!');
            contactForm.reset();
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 2000);
    });
});
</script>
@endpush