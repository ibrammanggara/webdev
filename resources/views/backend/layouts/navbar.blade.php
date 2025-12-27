<header class="bg-white/80 backdrop-blur rounded-2xl shadow-md px-6 py-4 flex justify-between items-center">
    <div class="flex items-center gap-4">
        <button onclick="toggleSidebar()" class="p-2 rounded-md cursor-pointer hover:bg-slate-200 transition focus:outline-none focus:ring-2 focus:ring-indigo-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-700">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 6.75h15M4.5 12h15M4.5 17.25h15" />
            </svg>
        </button>
    </div>

    <div class="flex items-center gap-3">
        <div class="w-9 h-9 rounded-full bg-indigo-500 text-white flex items-center justify-center font-semibold">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
    </div>
</header>
