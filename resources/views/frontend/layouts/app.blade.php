<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', setting('site.title', 'Website Pemerintah'))</title>
    <meta name="description" content="@yield('description', setting('site.description', 'Website resmi pemerintah'))">
    <meta name="keywords" content="@yield('keywords', setting('site.keywords', 'pemerintah, indonesia'))">
    
    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', setting('site.title', 'Website Pemerintah'))">
    <meta property="og:description" content="@yield('description', setting('site.description', 'Website resmi pemerintah'))">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .garuda-pattern {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 40 40'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M20 20c0-5.5-4.5-10-10-10s-10 4.5-10 10 4.5 10 10 10 10-4.5 10-10zm10 0c0-5.5-4.5-10-10-10s-10 4.5-10 10 4.5 10 10 10 10-4.5 10-10z'/%3E%3C/g%3E%3C/svg%3E");
        }
        
        .government-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%);
        }
        
        .red-white-gradient {
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 50%, #ffffff 100%);
        }
    </style>
    
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Skip to content -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-blue-600 text-white px-4 py-2 rounded-md z-50">
        Skip to main content
    </a>

    <!-- Top Header Bar -->
    <div class="bg-red-600 text-white py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center text-sm">
                <div class="flex items-center space-x-6">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                        {{ setting('contact.email', 'info@example.gov.id') }}
                    </span>
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                        </svg>
                        {{ setting('contact.phone', '021-1234567') }}
                    </span>
                </div>
                <div class="flex items-center space-x-4">
                    <span>{{ now()->locale('id')->translatedFormat('l, d F Y') }}</span>
                    <div class="flex items-center space-x-2">
                        <a href="#" class="hover:text-gray-300 transition-colors">
                            <span class="sr-only">Facebook</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" class="hover:text-gray-300 transition-colors">
                            <span class="sr-only">Twitter</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" class="hover:text-gray-300 transition-colors">
                            <span class="sr-only">Instagram</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C3.182 14.498 2.8 12.999 2.8 11.4c0-1.599.382-3.098 1.326-4.291.875-.807 2.026-1.297 3.323-1.297 1.297 0 2.448.49 3.323 1.297.944 1.193 1.326 2.692 1.326 4.291 0 1.599-.382 3.098-1.326 4.291-.875.807-2.026 1.297-3.323 1.297zm11.104-1.297c-.875.807-2.026 1.297-3.323 1.297-1.297 0-2.448-.49-3.323-1.297-.944-1.193-1.326-2.692-1.326-4.291 0-1.599.382-3.098 1.326-4.291.875-.807 2.026-1.297 3.323-1.297 1.297 0 2.448.49 3.323 1.297.944 1.193 1.326 2.692 1.326 4.291 0 1.599-.382 3.098-1.326 4.291z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="bg-white shadow-lg sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-4">
                        <img src="{{ asset('images/logo-garuda.png') }}" alt="Logo" class="h-12 w-auto">
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">{{ setting('site.title', 'Website Pemerintah') }}</h1>
                            <p class="text-sm text-gray-600">{{ setting('site.subtitle', 'Republik Indonesia') }}</p>
                        </div>
                    </a>
                </div>

                <!-- Search -->
                <div class="hidden md:flex items-center max-w-md mx-8 flex-1">
                    <div class="relative w-full">
                        <input type="search" 
                               placeholder="Cari berita, informasi..."
                               class="w-full px-4 py-2 pl-10 pr-4 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" id="mobile-menu-button" class="p-2 rounded-md text-gray-700 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="government-gradient garuda-pattern">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex space-x-8">
                    <a href="{{ route('home') }}" class="text-white hover:text-blue-200 px-3 py-4 text-sm font-medium border-b-2 border-transparent hover:border-blue-200 transition-all {{ request()->routeIs('home') ? 'border-blue-200 bg-blue-700/30' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('about') }}" class="text-white hover:text-blue-200 px-3 py-4 text-sm font-medium border-b-2 border-transparent hover:border-blue-200 transition-all {{ request()->routeIs('about') ? 'border-blue-200 bg-blue-700/30' : '' }}">
                        Tentang Kami
                    </a>
                    <a href="{{ route('news.index') }}" class="text-white hover:text-blue-200 px-3 py-4 text-sm font-medium border-b-2 border-transparent hover:border-blue-200 transition-all {{ request()->routeIs('news.*') ? 'border-blue-200 bg-blue-700/30' : '' }}">
                        Berita
                    </a>
                    <a href="{{ route('gallery.index') }}" class="text-white hover:text-blue-200 px-3 py-4 text-sm font-medium border-b-2 border-transparent hover:border-blue-200 transition-all {{ request()->routeIs('gallery.*') ? 'border-blue-200 bg-blue-700/30' : '' }}">
                        Galeri
                    </a>
                    <a href="{{ route('contact') }}" class="text-white hover:text-blue-200 px-3 py-4 text-sm font-medium border-b-2 border-transparent hover:border-blue-200 transition-all {{ request()->routeIs('contact') ? 'border-blue-200 bg-blue-700/30' : '' }}">
                        Kontak
                    </a>
                </div>
            </div>
        </nav>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="md:hidden hidden bg-blue-600">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="text-white hover:text-blue-200 block px-3 py-2 text-base font-medium">Beranda</a>
                <a href="{{ route('about') }}" class="text-white hover:text-blue-200 block px-3 py-2 text-base font-medium">Tentang Kami</a>
                <a href="{{ route('news.index') }}" class="text-white hover:text-blue-200 block px-3 py-2 text-base font-medium">Berita</a>
                <a href="{{ route('gallery.index') }}" class="text-white hover:text-blue-200 block px-3 py-2 text-base font-medium">Galeri</a>
                <a href="{{ route('contact') }}" class="text-white hover:text-blue-200 block px-3 py-2 text-base font-medium">Kontak</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main id="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <!-- Main Footer -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('images/logo-garuda.png') }}" alt="Logo" class="h-10 w-auto">
                        <div>
                            <h3 class="text-lg font-semibold">{{ setting('site.title', 'Website Pemerintah') }}</h3>
                            <p class="text-gray-400 text-sm">{{ setting('site.subtitle', 'Republik Indonesia') }}</p>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-4">{{ setting('site.description', 'Website resmi pemerintah yang menyediakan informasi dan layanan kepada masyarakat.') }}</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C3.182 14.498 2.8 12.999 2.8 11.4c0-1.599.382-3.098 1.326-4.291.875-.807 2.026-1.297 3.323-1.297 1.297 0 2.448.49 3.323 1.297.944 1.193 1.326 2.692 1.326 4.291 0 1.599-.382 3.098-1.326 4.291-.875.807-2.026 1.297-3.323 1.297zm11.104-1.297c-.875.807-2.026 1.297-3.323 1.297-1.297 0-2.448-.49-3.323-1.297-.944-1.193-1.326-2.692-1.326-4.291 0-1.599.382-3.098 1.326-4.291.875-.807 2.026-1.297 3.323-1.297 1.297 0 2.448.49 3.323 1.297.944 1.193 1.326 2.692 1.326 4.291 0 1.599-.382 3.098-1.326 4.291z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('news.index') }}" class="text-gray-300 hover:text-white transition-colors">Berita</a></li>
                        <li><a href="{{ route('gallery.index') }}" class="text-gray-300 hover:text-white transition-colors">Galeri</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <div class="space-y-2 text-gray-300">
                        <p class="flex items-start">
                            <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                            {{ setting('contact.address', 'Jl. Example No. 123, Jakarta, Indonesia') }}
                        </p>
                        <p class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                            </svg>
                            {{ setting('contact.phone', '021-1234567') }}
                        </p>
                        <p class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            {{ setting('contact.email', 'info@example.gov.id') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} {{ setting('site.title', 'Website Pemerintah') }}. Hak Cipta Dilindungi.</p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Kebijakan Privasi</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Syarat & Ketentuan</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scroll-to-top" class="fixed bottom-8 right-8 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition-all duration-300 opacity-0 invisible">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Scroll to top
        const scrollToTopBtn = document.getElementById('scroll-to-top');
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.remove('opacity-0', 'invisible');
                scrollToTopBtn.classList.add('opacity-100', 'visible');
            } else {
                scrollToTopBtn.classList.add('opacity-0', 'invisible');
                scrollToTopBtn.classList.remove('opacity-100', 'visible');
            }
        });

        scrollToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>