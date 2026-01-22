<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
    @stack('styles')
</head>
<body class="bg-slate-100 min-h-screen">
    <div class="p-6">
        <div class="relative min-h-[calc(100vh-3rem)]">

            {{-- SIDEBAR --}}
            @include('backend.layouts.sidebar')

            {{-- OVERLAY --}}
            <div id="sidebarOverlay" 
                 onclick="toggleSidebar()" 
                 class="fixed inset-0 bg-black/30 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300 z-20">
            </div>

            {{-- MAIN --}}
            <div id="mainContent" class="ml-0 transition-all duration-300">
                {{-- NAVBAR --}}
                @include('backend.layouts.navbar')
                {{-- CONTENT --}}
                <main class="mt-6 bg-white rounded-2xl shadow-md p-6">
                    @yield('content')
                </main>
            </div>

            {{-- GLOBAL IMAGE LIGHTBOX --}}
            <div id="imageLightbox"
                class="fixed inset-0 bg-black/80 hidden z-50 flex items-center justify-center">

                <button onclick="closeLightbox()"
                        class="absolute top-6 right-6 text-white text-3xl font-bold">
                    ✕
                </button>

                <img id="lightboxImage"
                    class="max-w-[90vw] max-h-[90vh] object-contain rounded-lg shadow-lg">
            </div>
        </div>
    </div>
    @include('backend.layouts.script')
    @stack('scripts')
    <script>
        function openLightbox(src) {
            const modal = document.getElementById('imageLightbox');
            const img = document.getElementById('lightboxImage');

            img.src = src;
            modal.classList.remove('hidden');
        }

        function closeLightbox() {
            const modal = document.getElementById('imageLightbox');
            const img = document.getElementById('lightboxImage');

            img.src = '';
            modal.classList.add('hidden');
        }

        // Klik background untuk close
        document.getElementById('imageLightbox')?.addEventListener('click', function (e) {
            if (e.target === this) {
                closeLightbox();
            }
        });
    </script>
</body>
</html>
