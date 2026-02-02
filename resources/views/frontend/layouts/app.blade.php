<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bhakti Bumi Sukowati</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Tailwind --}}
    @vite('resources/css/app.css')

    {{-- Alpine.js (WAJIB untuk hamburger) --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased text-slate-800 bg-white">

    {{-- TOP BAR --}}
    <div class="bg-green-800 text-white text-xs md:text-sm">
        <div class="max-w-7xl mx-auto flex justify-center gap-8 px-4 py-2">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.125 1.125 0 00-1.173.417l-.97 1.293a1.125 1.125 0 01-1.21.38 12.035 12.035 0 01-7.143-7.143z"/>
                </svg>
                0812-3456-7890
            </div>

            <div class="flex items-center gap-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                </svg>
                Sragen, Jawa Tengah
            </div>
        </div>
    </div>

    {{-- NAVBAR --}}
    <nav class="bg-green-600 sticky top-0 z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-3 text-white">

            {{-- Logo --}}
            <img src="{{ asset('images/logo.png') }}" alt="Bhakti Bumi Sukowati"
                 class="h-9 w-auto">

            {{-- Menu Desktop --}}
            <ul class="hidden md:flex space-x-8 text-sm font-medium">
                <li>
                    <a href="{{ route('home') }}"
                       class="{{ request()->routeIs('home')
                            ? 'font-semibold border-b-2 border-white pb-1'
                            : 'text-white/80 hover:text-white' }}">
                        Home
                    </a>
                </li>
                <li class="text-white/80 hover:text-white">Produk</li>
                <li class="text-white/80 hover:text-white">Galeri</li>
                <li class="text-white/80 hover:text-white">Kontak</li>
            </ul>

            {{-- Hamburger Button --}}
            <button class="md:hidden" @click="open = !open">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/>
                </svg>
            </button>
        </div>

        {{-- MENU MOBILE --}}
        <div x-show="open"
             x-transition
             @click.outside="open = false"
             class="md:hidden bg-green-700 text-white">

            <ul class="flex flex-col space-y-4 px-6 py-4 text-sm font-medium">
                <li>
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') 
                    ? 'font-semibold border-b-2 border-white pb-1'
                    : 'block hover:text-white/80' }}">
                        Home
                    </a>
                </li>
                <li><a href="#" class="block hover:text-white/80">Produk</a></li>
                <li><a href="#" class="block hover:text-white/80">Galeri</a></li>
                <li><a href="#" class="block hover:text-white/80">Kontak</a></li>
            </ul>
        </div>
    </nav>

    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>

</body>
</html>
