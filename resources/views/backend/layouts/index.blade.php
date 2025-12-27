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
        </div>
    </div>
    @include('backend.layouts.script')
    @stack('scripts')
</body>
</html>
