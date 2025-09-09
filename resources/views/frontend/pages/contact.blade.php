@extends('frontend.layouts.app')

@section('title', 'Kontak - ' . setting('site.title', 'Website Pemerintah'))
@section('description', 'Hubungi kami untuk informasi lebih lanjut tentang layanan ' . setting('site.title', 'Website Pemerintah'))

@section('content')
<!-- Page Header -->
<section class="bg-blue-800 py-12">
    <div class="container mx-auto px-4">
        <div class="text-center text-white">
            <h1 class="text-3xl md:text-4xl font-bold mb-4 flex items-center justify-center">
                <i class="fas fa-phone text-yellow-400 mr-3"></i>
                Kontak Kami
            </h1>
            <p class="text-lg text-blue-100">Kami siap membantu dan melayani Anda dengan sepenuh hati</p>
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
                <li class="text-blue-800 font-medium">Kontak</li>
            </ol>
        </nav>
    </div>
</section>

<div class="container mx-auto px-4 py-12">
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
            <h2 class="text-2xl font-bold text-blue-800 mb-8 flex items-center">
                <i class="fas fa-info-circle text-yellow-400 mr-2"></i>
                Informasi Kontak
            </h2>

            <div class="space-y-6">
                <!-- Address -->
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-blue-800 mb-2">Alamat</h3>
                        <p class="text-gray-600">{{ setting('contact.address', 'Jl. Example No. 123, Jakarta, Indonesia 12345') }}</p>
                    </div>
                </div>

                <!-- Phone -->
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-phone text-white"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-blue-800 mb-2">Telepon</h3>
                        <p class="text-gray-600">{{ setting('contact.phone', '021-1234567') }}</p>
                        @if(setting('contact.phone2'))
                        <p class="text-gray-600">{{ setting('contact.phone2') }}</p>
                        @endif
                    </div>
                </div>

                <!-- Email -->
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-envelope text-white"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-blue-800 mb-2">Email</h3>
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
                            <i class="fas fa-clock text-white"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-blue-800 mb-2">Jam Operasional</h3>
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
                <h3 class="text-lg font-semibold text-blue-800 mb-4 flex items-center">
                    <i class="fas fa-share-alt text-yellow-400 mr-2"></i>
                    Ikuti Kami
                </h3>
                <div class="flex space-x-4">
                    @if(setting('social.facebook'))
                    <a href="{{ setting('social.facebook') }}" target="_blank"
                       class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white hover:bg-blue-700 transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    @endif

                    @if(setting('social.twitter'))
                    <a href="{{ setting('social.twitter') }}" target="_blank"
                       class="w-10 h-10 bg-sky-500 rounded-lg flex items-center justify-center text-white hover:bg-sky-600 transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    @endif

                    @if(setting('social.instagram'))
                    <a href="{{ setting('social.instagram') }}" target="_blank"
                       class="w-10 h-10 bg-pink-600 rounded-lg flex items-center justify-center text-white hover:bg-pink-700 transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    @endif

                    @if(setting('social.youtube'))
                    <a href="{{ setting('social.youtube') }}" target="_blank"
                       class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center text-white hover:bg-red-700 transition-colors">
                        <i class="fab fa-youtube"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div>
            <h2 class="text-2xl font-bold text-blue-800 mb-8 flex items-center">
                <i class="fas fa-paper-plane text-yellow-400 mr-2"></i>
                Kirim Pesan
            </h2>

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
                        <i class="fas fa-paper-plane mr-2"></i>
                        Kirim Pesan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Map Section -->
    @if(setting('contact.map_embed'))
    <div class="mt-16">
        <h2 class="text-2xl font-bold text-blue-800 mb-8 text-center flex items-center justify-center">
            <i class="fas fa-map-marked-alt text-yellow-400 mr-2"></i>
            Lokasi Kami
        </h2>
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
