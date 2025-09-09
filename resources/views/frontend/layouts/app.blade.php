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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .hero-slider {
            position: relative;
            width: 100%;
            height: calc(100vh - 140px); /* Subtract topbar (42px) + header (70px) + nav (28px) */
            overflow: hidden;
        }

        .hero-slider img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .hero-slider {
                height: calc(100vh - 160px); /* Mobile: account for stacked header elements */
                margin-top: 0;
            }
        }

        .marquee-container {
            overflow: hidden;
            white-space: nowrap;
        }

        .marquee-content {
            display: inline-block;
            animation: marquee 20s linear infinite;
        }

        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        .garuda-pattern {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 40 40'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M20 20c0-5.5-4.5-10-10-10s-10 4.5-10 10 4.5 10 10 10 10-4.5 10-10zm10 0c0-5.5-4.5-10-10-10s-10 4.5-10 10 4.5 10 10 10 10-4.5 10-10z'/%3E%3C/g%3E%3C/svg%3E");
        }

        .government-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%);
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Skip to content -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-blue-600 text-white px-4 py-2 rounded-md z-50">
        Skip to main content
    </a>

    <!-- Top Bar -->
    <div class="bg-blue-800 text-white py-2 px-4">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
            <div class="text-sm mb-2 md:mb-0">
                <span class="mr-4"><i class="fas fa-phone-alt mr-1"></i> {{ setting('contact.phone', '(0741) 1234567') }}</span>
                <span><i class="fas fa-envelope mr-1"></i> {{ setting('contact.email', 'pupr@jambiprov.go.id') }}</span>
            </div>
            <div class="flex space-x-4">
                <a href="#" class="text-white hover:text-yellow-300"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white hover:text-yellow-300"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white hover:text-yellow-300"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white hover:text-yellow-300"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center mb-4 md:mb-0">
                <img src="{{ asset('images/logo-ok1.png') }}" alt="PUPR Logo" class="h-16 mr-4">
                <div>
                    <h1 class="text-2xl font-bold text-blue-800">{{ strtoupper(setting('site.title', 'PEMERINTAH PROVINSI JAMBI')) }}</h1>
                    <p class="text-sm text-gray-600">{{ setting('site.subtitle', 'Dinas Pekerjaan Umum dan Perumahan Rakyat') }}</p>
                </div>
            </div>
            <div class="relative">
                <input type="text" placeholder="Search..." class="border border-gray-300 rounded-full py-2 px-4 w-full md:w-64 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                <button class="absolute right-3 top-2 text-gray-500 hover:text-blue-800">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </header>

        <!-- Navigation -->
        <nav class="bg-blue-700 text-white sticky top-0 z-50 shadow-lg">
            <div class="container mx-auto px-4">
                <!-- Mobile Menu Button -->
                <div class="md:hidden flex justify-end py-3">
                    <button id="mobileMenuButton" class="text-white hover:text-yellow-300 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>

                <!-- Navigation Menu -->
                <div id="navMenu" class="hidden md:flex flex-col md:flex-row">
                    <a href="{{ route('home') }}" class="py-3 px-4 hover:bg-blue-800 font-medium flex items-center {{ request()->routeIs('home') ? 'bg-blue-800' : '' }}">
                        <i class="fas fa-home mr-2"></i> Beranda
                    </a>

                    @foreach($mainMenuPages as $page)
                        @if($page->children->count() > 0)
                            <!-- Dropdown menu for pages with children -->
                            <div class="dropdown relative">
                                <button class="py-3 px-4 hover:bg-blue-800 font-medium flex items-center w-full md:w-auto justify-between">
                                    <span class="flex items-center">
                                        <i class="{{ $page->icon }} mr-2"></i> {{ $page->title }}
                                    </span>
                                    <i class="fas fa-chevron-down ml-2 text-xs"></i>
                                </button>
                                <div class="dropdown-menu absolute left-0 mt-0 w-full md:w-48 bg-white text-gray-800 shadow-lg rounded-b-md hidden">
                                    @foreach($page->children as $index => $child)
                                        <a href="{{ route('page.show', $child->slug) }}"
                                           class="block px-4 py-2 hover:bg-blue-100 {{ $index < $page->children->count() - 1 ? 'border-b border-gray-100' : 'rounded-b-md' }}">
                                            {{ $child->title }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <!-- Single menu item -->
                            <a href="{{ route('page.show', $page->slug) }}" class="py-3 px-4 hover:bg-blue-800 font-medium flex items-center {{ request()->route('slug') == $page->slug ? 'bg-blue-800' : '' }}">
                                <i class="{{ $page->icon }} mr-2"></i> {{ $page->title }}
                            </a>
                        @endif
                    @endforeach

                    <!-- Static menu items -->
                    <a href="{{ route('news.index') }}" class="py-3 px-4 hover:bg-blue-800 font-medium flex items-center {{ request()->routeIs('news.*') ? 'bg-blue-800' : '' }}">
                        <i class="fas fa-newspaper mr-2"></i> Berita
                    </a>

                    <a href="#" class="py-3 px-4 hover:bg-blue-800 font-medium flex items-center">
                        <i class="fas fa-chart-line mr-2"></i> Data & Statistik
                    </a>

                    <a href="#" class="py-3 px-4 hover:bg-blue-800 font-medium flex items-center">
                        <i class="fas fa-file-alt mr-2"></i> Publikasi
                    </a>

                    @if(isset($mainMenuPages) && $mainMenuPages->where('slug', 'contact')->count() == 0)
                        <!-- Show contact link if not in dynamic menu -->
                        <a href="{{ route('contact') }}" class="py-3 px-4 hover:bg-blue-800 font-medium flex items-center {{ request()->routeIs('contact') ? 'bg-blue-800' : '' }}">
                            <i class="fas fa-headset mr-2"></i> Layanan Publik
                        </a>
                    @endif
                </div>
            </div>
        </nav>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="md:hidden hidden bg-blue-600">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="text-white hover:text-blue-200 block px-3 py-2 text-base font-medium {{ request()->routeIs('home') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-home mr-2"></i> Beranda
                </a>

                @foreach($mainMenuPages as $page)
                    @if($page->children->count() > 0)
                        <!-- Parent page with children -->
                        <div class="space-y-1">
                            <div class="text-white px-3 py-2 text-base font-medium bg-blue-700">
                                <i class="{{ $page->icon }} mr-2"></i> {{ $page->title }}
                            </div>
                            @foreach($page->children as $child)
                                <a href="{{ route('page.show', $child->slug) }}" class="text-white hover:text-blue-200 block px-6 py-2 text-sm font-medium">
                                    {{ $child->title }}
                                </a>
                            @endforeach
                        </div>
                    @else
                        <!-- Single page -->
                        <a href="{{ route('page.show', $page->slug) }}" class="text-white hover:text-blue-200 block px-3 py-2 text-base font-medium {{ request()->route('slug') == $page->slug ? 'bg-blue-700' : '' }}">
                            <i class="{{ $page->icon }} mr-2"></i> {{ $page->title }}
                        </a>
                    @endif
                @endforeach

                <a href="{{ route('news.index') }}" class="text-white hover:text-blue-200 block px-3 py-2 text-base font-medium {{ request()->routeIs('news.*') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-newspaper mr-2"></i> Berita
                </a>
                <a href="{{ route('gallery.index') }}" class="text-white hover:text-blue-200 block px-3 py-2 text-base font-medium {{ request()->routeIs('gallery.*') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-images mr-2"></i> Galeri
                </a>

                @if(isset($mainMenuPages) && $mainMenuPages->where('slug', 'contact')->count() == 0)
                    <!-- Show contact link if not in dynamic menu -->
                    <a href="{{ route('contact') }}" class="text-white hover:text-blue-200 block px-3 py-2 text-base font-medium {{ request()->routeIs('contact') ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-headset mr-2"></i> Kontak
                    </a>
                @endif
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main id="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <div>
                    <h4 class="text-xl font-bold mb-4 text-yellow-400">Tentang Kami</h4>
                    <p class="text-sm mb-4">{{ setting('site.title', 'Dinas PUPR') }} Provinsi Jambi berkomitmen untuk mewujudkan Jambi Mantap melalui berbagai program pembangunan infrastruktur dan perumahan rakyat.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-white hover:text-yellow-400"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white hover:text-yellow-400"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white hover:text-yellow-400"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white hover:text-yellow-400"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <div>
                    <h4 class="text-xl font-bold mb-4 text-yellow-400">Link Terkait</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-white hover:text-yellow-400 text-sm">Kementerian Dalam Negeri</a></li>
                        <li><a href="#" class="text-white hover:text-yellow-400 text-sm">Badan Pusat Statistik</a></li>
                        <li><a href="#" class="text-white hover:text-yellow-400 text-sm">Kementerian PUPR</a></li>
                        <li><a href="#" class="text-white hover:text-yellow-400 text-sm">BPK RI</a></li>
                        <li><a href="#" class="text-white hover:text-yellow-400 text-sm">Pemerintah Provinsi Jambi</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xl font-bold mb-4 text-yellow-400">Layanan Publik</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-white hover:text-yellow-400 text-sm">Pengaduan Masyarakat</a></li>
                        <li><a href="#" class="text-white hover:text-yellow-400 text-sm">Perizinan Online</a></li>
                        <li><a href="#" class="text-white hover:text-yellow-400 text-sm">Data Terbuka</a></li>
                        <li><a href="#" class="text-white hover:text-yellow-400 text-sm">E-Government</a></li>
                        <li><a href="#" class="text-white hover:text-yellow-400 text-sm">Lowongan Kerja</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xl font-bold mb-4 text-yellow-400">Kontak Kami</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-yellow-400"></i>
                            <span class="text-sm">{{ setting('contact.address', 'Jl. Jend. A. Yani No. 1, Jambi') }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3 text-yellow-400"></i>
                            <span class="text-sm">{{ setting('contact.phone', '(0741) 1234567') }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-yellow-400"></i>
                            <span class="text-sm">{{ setting('contact.email', 'pupr@jambiprov.go.id') }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-clock mr-3 text-yellow-400"></i>
                            <span class="text-sm">Senin-Jumat: 08.00-16.00 WIB</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-blue-800 pt-6">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <img src="{{ asset('images/logo-garuda.png') }}" alt="Logo" class="h-12">
                    </div>
                    <div class="text-sm text-center md:text-right">
                        <p>&copy; {{ date('Y') }} {{ setting('site.title', 'Dinas PUPR') }} Provinsi Jambi. Seluruh hak cipta dilindungi.</p>
                        <p class="mt-1">Dikembangkan oleh Tim IT {{ setting('site.title', 'PUPR') }} Provinsi Jambi</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-6 right-6 bg-blue-800 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center hidden hover:bg-blue-700 transition-colors duration-300">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobileMenuButton');
            const navMenu = document.getElementById('navMenu');
            const mobileMenu = document.getElementById('mobile-menu');

            // Main navigation toggle for mobile
            if (mobileMenuButton && navMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    navMenu.classList.toggle('hidden');
                    navMenu.classList.toggle('flex');
                });
            }

            // Mobile menu toggle
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // Dropdown functionality for mobile and desktop
            const dropdowns = document.querySelectorAll('.dropdown');

            dropdowns.forEach(dropdown => {
                const button = dropdown.querySelector('button');
                const menu = dropdown.querySelector('.dropdown-menu');

                // Mobile dropdown toggle
                if (window.innerWidth < 768 && button && menu) {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        menu.classList.toggle('hidden');
                    });
                }
            });
        });

        // Back to Top functionality
        const backToTopBtn = document.getElementById('backToTop');

        if (backToTopBtn) {
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopBtn.classList.remove('hidden');
                } else {
                    backToTopBtn.classList.add('hidden');
                }
            });

            backToTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
