@extends('backend.layouts.index')

@section('title', 'Produk')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-semibold text-gray-800">
            Produk
        </h1>
        <p class="text-sm text-gray-500">
            Kelola data produk
        </p>
    </div>

    <a href="{{ route('product.create') }}"
       class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg text-sm shadow transition">
        + Tambah Produk
    </a>
</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-gray-600">
                <tr>
                    <th class="p-4 text-left">No</th>
                    <th class="p-4 text-left">Cover</th>
                    <th class="p-4 text-left">Nama Produk</th>
                    <th class="p-4 text-left">Kategori</th>
                    <th class="p-4 text-left">Harga</th>
                    <th class="p-4 text-left">Stok</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($products as $product)
                    <tr class="border-t border-slate-100 hover:bg-slate-50 transition">
                        <td class="p-4">
                            {{ $products->firstItem() + $loop->index }}
                        </td>

                        <td class="p-4">
                            @if($product->cover_image)
                                <img src="{{ asset('storage/' . $product->cover_image) }}"
                                     onclick="openLightbox(this.src)"
                                     class="w-20 h-14 object-cover rounded-lg cursor-pointer hover:opacity-90 transition">
                            @else
                                <div class="w-20 h-14 flex items-center justify-center
                                            bg-slate-100 text-slate-400 rounded-lg text-xs">
                                    No Image
                                </div>
                            @endif
                        </td>

                        <td class="p-4 font-medium text-gray-800">
                            {{ $product->name }}
                        </td>

                        <td class="p-4 text-gray-600">
                            {{ $product->category ?? '-' }}
                        </td>

                        <td class="p-4 text-gray-800">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        <td class="p-4 text-gray-600">
                            {{ $product->stock }}
                        </td>

                        <td class="p-4">
                            @if($product->is_active)
                                <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-600">
                                    Aktif
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs rounded-full bg-rose-100 text-rose-600">
                                    Nonaktif
                                </span>
                            @endif
                        </td>

                        <td class="p-4">
                            <div class="flex gap-2">
                                <a href="{{ route('product.show', $product) }}"
                                   class="px-3 py-1.5 text-xs rounded-lg
                                          bg-indigo-100 text-indigo-600 hover:bg-indigo-200 transition">
                                    Detail
                                </a>

                                <a href="{{ route('product.edit', $product) }}"
                                   class="px-3 py-1.5 text-xs rounded-lg
                                          bg-amber-100 text-amber-600 hover:bg-amber-200 transition">
                                    Edit
                                </a>

                                <form action="{{ route('product.destroy', $product) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1.5 text-xs rounded-lg
                                                   bg-rose-100 text-rose-600 hover:bg-rose-200 transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="p-8 text-center text-gray-500">
                            Belum ada data produk
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="p-4">
    {{ $products->links() }}
</div>
@endsection
