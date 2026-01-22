@extends('backend.layouts.index')

@section('title', 'Detail Produk')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- HEADER -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">
                Detail Produk
            </h1>
            <p class="text-sm text-gray-500">
                Informasi lengkap produk
            </p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('product.edit', $product) }}"
               class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg text-sm shadow transition">
                Edit
            </a>

            <a href="{{ route('product.index') }}"
               class="px-4 py-2 rounded-lg border border-slate-300 text-gray-700 hover:bg-slate-100 transition">
                Kembali
            </a>
        </div>
    </div>

    <!-- CARD -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <!-- COVER -->
        @if($product->cover_image)
            <div class="relative">
                <img src="{{ asset('storage/'.$product->cover_image) }}" onclick="openLightbox(this.src)"
                     class="w-full max-h-[420px] object-cover cursor-pointer hover:opacity-90 transition">

                <!-- STATUS -->
                <div class="absolute top-4 right-4">
                    @if($product->is_active)
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
        @endif

        <!-- CONTENT -->
        <div class="p-6 space-y-6">
            <!-- TITLE -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ $product->name }}
                </h2>

                <div class="mt-2 flex flex-wrap gap-4 text-sm text-gray-500">
                    @if($product->category)
                        <div>
                            🏷️ {{ $product->category }}
                        </div>
                    @endif

                    <div>
                        📦 Stok: {{ $product->stock }}
                    </div>
                </div>
            </div>

            <!-- HARGA -->
            <div class="flex items-center gap-4">
                @if($product->discount_price)
                    <span class="text-xl font-bold text-rose-600">
                        Rp {{ number_format($product->discount_price, 0, ',', '.') }}
                    </span>
                    <span class="text-sm line-through text-gray-400">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                @else
                    <span class="text-xl font-bold text-gray-800">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                @endif
            </div>

            <!-- DESKRIPSI -->
            @if($product->description)
                <div class="prose max-w-none text-gray-700">
                    {!! nl2br(e($product->description)) !!}
                </div>
            @endif

            <!-- GALERI FOTO -->
            @if($product->images->count())
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">
                        Galeri Produk
                    </h3>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($product->images as $img)
                            <div class="group relative">
                                <img src="{{ asset('storage/'.$img->image) }}"
                                     class="w-full h-36 object-cover rounded-lg border
                                            cursor-pointer hover:opacity-90 transition">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- META -->
            <div class="pt-4 border-t text-sm text-gray-500">
                <p>
                    Dibuat: {{ $product->created_at->translatedFormat('d F Y, H:i') }}
                </p>
                <p>
                    Terakhir diperbarui: {{ $product->updated_at->translatedFormat('d F Y, H:i') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
