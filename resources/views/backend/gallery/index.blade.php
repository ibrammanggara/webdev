@extends('backend.layouts.index')

@section('title', 'Galeri')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">
                Galeri
            </h1>
            <p class="text-sm text-gray-500">
                Kelola data galeri
            </p>
        </div>

        <a href="{{ route('gallery.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg text-sm shadow transition">
            + Tambah Galeri
        </a>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-gray-600">
                    <tr>
                        <th class="p-4 font-medium text-left">No</th>
                        <th class="p-4 font-medium text-left">Gambar</th>
                        <th class="p-4 font-medium text-left">Judul</th>
                        <th class="p-4 font-medium text-left">Status</th>
                        <th class="p-4 font-medium text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($galleries as $gallery)
                        <tr class="border-t border-slate-100 hover:bg-slate-50 transition">
                            <td class="p-4">
                                {{ $galleries->firstItem() + $loop->index }}
                            </td>

                            <td class="p-4">
                                <img
                                    onclick="openLightbox(this.src)"
                                    src="{{ asset('storage/' . $gallery->image) }}"
                                    class="w-20 h-14 object-cover cursor-pointer hover:opacity-90 transition"
                                    alt="Gallery Image">
                            </td>

                            <td class="p-4">
                                {{ $gallery->title ?? '-' }}
                            </td>

                            <td class="p-4">
                                @if($gallery->is_active)
                                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-600">
                                        Tampil
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full bg-rose-100 text-rose-600">
                                        Tidak Tampil
                                    </span>
                                @endif
                            </td>

                            <td class="p-4">
                              <div class="flex gap-2">
                                  <a href="{{ route('gallery.show', $gallery) }}"
                                    class="px-3 py-1.5 text-xs rounded-lg bg-indigo-100 text-indigo-600 hover:bg-indigo-200 transition">
                                      Detail
                                  </a>

                                  <a href="{{ route('gallery.edit', $gallery) }}"
                                    class="px-3 py-1.5 text-xs rounded-lg bg-amber-100 text-amber-600 hover:bg-amber-200 transition">
                                      Edit
                                  </a>

                                  <form action="{{ route('gallery.destroy', $gallery) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit"
                                              class="px-3 py-1.5 text-xs rounded-lg bg-rose-100 text-rose-600 hover:bg-rose-200 transition">
                                          Hapus
                                      </button>
                                  </form>
                              </div>
                          </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-500">
                                Belum ada data galeri
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="p-4">
      {{ $galleries->links() }}
    </div>
@endsection
