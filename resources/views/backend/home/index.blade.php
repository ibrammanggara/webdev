@extends('backend.layouts.index')

@section('title', 'Dashboard')

@push('styles')
<style>
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px) scale(0.98);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    .animate-slide-in {
        animation: slideIn 0.25s ease-out;
    }
</style>
@endpush

@section('content')
    {{-- TOAST NOTIFICATION --}}
    @if(session('success') || $errors->any())
        <div
            id="toast"
            class="fixed top-6 right-6 z-50 max-w-sm w-full bg-white border border-slate-200 rounded-xl shadow-lg px-4 py-3 flex gap-3 items-start animate-slide-in">
            {{-- ICON --}}
            <div class="mt-0.5">
                @if(session('success'))
                    <svg class="w-5 h-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75" />
                    </svg>
                @else
                    <svg class="w-5 h-5 text-rose-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3h.008M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                @endif
            </div>

            {{-- MESSAGE --}}
            <div class="flex-1 text-sm">
                @if(session('success'))
                    <p class="text-green-700 font-medium">
                        {{ session('success') }}
                    </p>
                @else
                    <p class="text-rose-600 font-medium">
                        {{ $errors->first() }}
                    </p>
                @endif
            </div>

            {{-- CLOSE --}}
            <button onclick="closeToast()" class="text-slate-400 hover:text-slate-600">
                ✕
            </button>
        </div>
    @endif

    <h1 class="text-2xl font-semibold text-gray-800 mb-4">
        Dashboard
    </h1>

    <p class="text-gray-600 mb-6">
        Selamat datang di Admin Panel
    </p>

    <div class="bg-white p-6 rounded-xl shadow mb-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-800">
                Diagram Aktivitas
            </h2>
            <span class="text-sm text-gray-500">
                7 Hari Terakhir
            </span>
        </div>

        <canvas id="activityChart" height="100"></canvas>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Users -->
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">User</p>
                    <h2 class="text-3xl font-bold text-gray-800">{{ $totalUsers }}</h2>
                </div>
                <div class="bg-indigo-100 text-indigo-600 p-3 rounded-lg">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0ZM4.5 20.25a8.25 8.25 0 0115 0" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Galeri -->
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Galeri</p>
                    <h2 class="text-3xl font-bold text-gray-800">32</h2>
                </div>
                <div class="bg-purple-100 text-purple-600 p-3 rounded-lg">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5.25A2.25 2.25 0 015.25 3h13.5A2.25 2.25 0 0121 5.25v13.5A2.25 2.25 0 0118.75 21H5.25A2.25 2.25 0 013 18.75V5.25z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5l4.5-4.5a2.25 2.25 0 013.182 0l4.5 4.5" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Aktivitas -->
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Aktivitas</p>
                    <h2 class="text-3xl font-bold text-gray-800">89</h2>
                </div>
                <div class="bg-green-100 text-green-600 p-3 rounded-lg">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 15l3-3 3 3 4.5-6" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Products -->
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Produk</p>
                    <h2 class="text-3xl font-bold text-gray-800">45</h2>
                </div>
                <div class="bg-orange-100 text-orange-600 p-3 rounded-lg">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-8.25-4.5-8.25 4.5m16.5 0v9.75A2.25 2.25 0 0118.75 19.5H5.25A2.25 2.25 0 013 17.25V7.5m17.25 0L12 12.75 3.75 7.5" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div id="users" class="mt-12">
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <!-- FORM -->
            <div class="px-6 py-4 bg-slate-50">
                <form action="{{ route('users.store') }}" method="POST" class="flex flex-row flex-wrap md:flex-nowrap gap-4 items-end">
                    @csrf
                    <!-- Nama -->
                    <div class="w-full md:flex-1">
                        <label class="text-sm text-gray-600 mb-1 block">
                            Nama User
                        </label>
                        <input name="name" placeholder="Masukkan nama" class="w-full rounded-lg px-3 py-2 bg-white border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>

                    <!-- Password -->
                    <div class="w-full md:flex-1">
                        <label class="text-sm text-gray-600 mb-1 block">
                            Password
                        </label>
                        <input type="password" name="password" placeholder="Minimal 6 karakter" class="w-full rounded-lg px-3 py-2 bg-white border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>

                    <!-- Button -->
                    <div class="w-full md:w-auto">
                        <button type="submit" class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg transition shadow-sm cursor-pointer">
                            Tambah User
                        </button>
                    </div>
                </form>
            </div>

            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-left text-gray-600">
                        <tr>
                            <th class="p-4 font-medium">Nama</th>
                            <th class="p-4 font-medium">Password</th>
                            <th class="p-4 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-t border-slate-100">
                                <td class="p-4">{{ $user->name }}</td>
                                <td class="p-4">{{ $user->password }}</td>
                                <td class="p-4">
                                    <form method="POST" action="{{ route('users.destroy', $user) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')" class="text-rose-500 hover:text-rose-600 text-sm cursor-pointer" >
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="p-6 text-center text-gray-500">
                                    Belum ada user
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('activityChart');
        if (!ctx) return;

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [
                    {
                        label: 'User',
                        data: @json($chartData),
                        borderColor: '#4f46e5',
                        backgroundColor: 'rgba(79,70,229,0.1)',
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            boxWidth: 7,
                            boxHeight: 7,
                            padding: 20
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    });
</script>

<script>
    function closeToast() {
        const toast = document.getElementById('toast');
        if (toast) toast.remove();
    }

    document.addEventListener('DOMContentLoaded', function () {
        const toast = document.getElementById('toast');
        if (toast) {
            setTimeout(() => {
                toast.classList.add('opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }
    });
</script>

@endpush