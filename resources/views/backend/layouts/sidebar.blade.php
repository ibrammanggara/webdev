<aside id="sidebar" class="fixed top-6 left-6 w-64 h-[calc(100vh-3rem)] bg-slate-800 text-slate-200 rounded-2xl shadow-lg transition-transform duration-300 ease-in-out -translate-x-72 z-30">
    <!-- USER HEADER -->
    <div class="flex flex-col items-center px-6 py-8 border-b border-slate-700">
        <div class="w-20 h-20 rounded-full bg-indigo-600 text-white flex items-center justify-center text-3xl font-semibold">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>

        <p class="mt-4 font-semibold text-slate-100">
            {{ Auth::user()->name }}
        </p>

        <p class="text-sm text-slate-400">
            Bhakti Bumi Sukowati
        </p>
    </div>

    <!-- MENU -->
    <nav class="flex-1 py-6 space-y-1">
        <!-- Dashboard -->
        <a href="/dashboard" class="group flex items-center gap-3 mx-3 px-4 py-2.5 rounded-lg text-sm transition-all {{ request()->is('dashboard') ? 'bg-indigo-500/10 text-indigo-400' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0 {{ request()->is('dashboard') ? 'text-indigo-400' : 'text-slate-400 group-hover:text-white' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h7v7H3V3zm11 0h7v7h-7V3zM3 14h7v7H3v-7zm11 4v-4h7v4h-7z"/>
            </svg>
            <span>Dashboard</span>
        </a>

        <!-- Galeri -->
        <a href="{{ route('gallery.index') }}"
           class="group flex items-center gap-3 mx-3 px-4 py-2.5 rounded-lg text-sm transition-all
           {{ request()->is('gallery*') ? 'bg-indigo-500/10 text-indigo-400' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0
                {{ request()->is('gallery*') ? 'text-indigo-400' : 'text-slate-400 group-hover:text-white' }}"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 5.25A2.25 2.25 0 015.25 3h13.5A2.25 2.25 0 0121 5.25v13.5A2.25 2.25 0 0118.75 21H5.25A2.25 2.25 0 013 18.75V5.25z"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 16.5l4.5-4.5a2.25 2.25 0 013.182 0l4.5 4.5"/>
            </svg>
            <span>Galeri</span>
        </a>

        <!-- Aktivitas -->
        <a href="{{ route('activity.index') }}"
        class="group flex items-center gap-3 mx-3 px-4 py-2.5 rounded-lg text-sm transition-all
        {{ request()->is('activity*') ? 'bg-indigo-500/10 text-indigo-400' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
            <svg class="w-5 h-5 shrink-0
                {{ request()->is('activity*') ? 'text-indigo-400' : 'text-slate-400 group-hover:text-white' }}"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 3v18h18"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M7.5 15l3-3 3 3 4.5-6"/>
            </svg>
            <span>Aktivitas</span>
        </a>

        <!-- Produk -->
        <a href="#"
            class="group flex items-center gap-3 mx-3 px-4 py-2.5 rounded-lg text-sm
            text-slate-300 hover:bg-slate-700 hover:text-white transition-all">
            <svg class="w-5 h-5 text-slate-400 group-hover:text-white"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M20.25 7.5l-8.25-4.5-8.25 4.5"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 7.5L12 12.75l8.25-5.25"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3.75 7.5v9.75A2.25 2.25 0 006 19.5h12a2.25 2.25 0 002.25-2.25V7.5"/>
            </svg>
            <span>Produk</span>
        </a>
    </nav>

    <!-- LOGOUT -->
    <div class="px-6 py-4 border-t border-slate-700">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-3 text-sm text-slate-400 hover:text-rose-400 transition cursor-pointer">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0110.5 3h6a2.25 2.25 0 012.25 2.25v13.5A2.25 2.25 0 0116.5 21h-6a2.25 2.25 0 01-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25"/>
                </svg>
                Logout
            </button>
        </form>
    </div>
</aside>
