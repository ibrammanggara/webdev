@extends('backend.layouts.index')

@section('title', 'Detail Galeri')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">
                Detail Galeri
            </h1>
            <p class="text-sm text-gray-500">
                Informasi lengkap galeri
            </p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('gallery.edit', $gallery) }}"
               class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg text-sm shadow transition">
                Edit
            </a>

            <a href="{{ route('gallery.index') }}"
               class="px-4 py-2 rounded-lg border border-slate-300 text-gray-700 hover:bg-slate-100 transition">
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <div class="relative">
            <img src="{{ asset('storage/' . $gallery->image) }}"
                 onclick="openLightbox(this.src)"
                 class="w-full max-h-105 object-cover cursor-pointer hover:opacity-90 transition">

            <div class="absolute top-4 right-4">
                @if($gallery->is_active)
                    <span class="px-4 py-1.5 text-sm rounded-full bg-green-100 text-green-600 shadow">
                        Aktif
                    </span>
                @else
                    <span class="px-4 py-1.5 text-sm rounded-full bg-rose-100 text-rose-600 shadow">
                        Nonaktif
                    </span>
                @endif
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">
                        Informasi Galeri
                    </h2>

                    <div class="space-y-2 text-sm text-gray-700">
                        <div>
                            <span class="text-gray-500">Judul:</span>
                            <p class="font-medium">
                                {{ $gallery->title ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <span class="text-gray-500">Dibuat:</span>
                            <p class="font-medium">
                                {{ $gallery->created_at->translatedFormat('d F Y, H:i') }}
                            </p>
                        </div>

                        <div>
                            <span class="text-gray-500">Terakhir diperbarui:</span>
                            <p class="font-medium">
                                {{ $gallery->updated_at->translatedFormat('d F Y, H:i') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col justify-between">
                    <div class="bg-slate-50 rounded-xl p-4 text-sm text-gray-600">
                        <p>
                            Gunakan tombol <b>Edit</b> untuk memperbarui gambar atau judul galeri.
                            Status aktif menentukan apakah galeri ditampilkan ke pengguna.
                        </p>
                    </div>

                    <div class="mt-6">
                        <form action="{{ route('gallery.destroy', $gallery) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="w-full bg-rose-600 hover:bg-rose-700 text-white px-6 py-2.5 rounded-lg shadow transition">
                                Hapus Galeri
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
