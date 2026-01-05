@extends('backend.layouts.index')

@section('title', 'Aktivitas')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-semibold text-gray-800">
            Aktivitas
        </h1>
        <p class="text-sm text-gray-500">
            Kelola data aktivitas / kegiatan
        </p>
    </div>

    <a href="{{ route('activity.create') }}"
       class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg text-sm shadow transition">
        + Tambah Aktivitas
    </a>
</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-gray-600">
                <tr>
                    <th class="p-4 text-left">No</th>
                    <th class="p-4 text-left">Cover</th>
                    <th class="p-4 text-left">Judul</th>
                    <th class="p-4 text-left">Tanggal</th>
                    <th class="p-4 text-left">Lokasi</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($activities as $activity)
                    <tr class="border-t border-slate-100 hover:bg-slate-50 transition">
                        <td class="p-4">
                            {{ $activities->firstItem() + $loop->index }}
                        </td>

                        <td class="p-4">
                            @if($activity->cover_image)
                                <img src="{{ asset('storage/' . $activity->cover_image) }}"
                                     class="w-20 h-14 object-cover">
                            @else
                                <div class="w-20 h-14 flex items-center justify-center
                                            bg-slate-100 text-slate-400 rounded-lg text-xs">
                                    No Image
                                </div>
                            @endif
                        </td>

                        <td class="p-4 font-medium text-gray-800">
                            {{ $activity->title }}
                        </td>

                        <td class="p-4 text-gray-600">
                            {{ $activity->activity_date
                                ? $activity->activity_date->translatedFormat('d M Y')
                                : '-' }}
                        </td>

                        <td class="p-4 text-gray-600">
                            {{ $activity->location ?? '-' }}
                        </td>

                        <td class="p-4">
                            @if($activity->is_active)
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
                                <a href="{{ route('activity.show', $activity) }}"
                                   class="px-3 py-1.5 text-xs rounded-lg
                                          bg-indigo-100 text-indigo-600 hover:bg-indigo-200 transition">
                                    Detail
                                </a>

                                <a href="{{ route('activity.edit', $activity) }}"
                                   class="px-3 py-1.5 text-xs rounded-lg
                                          bg-amber-100 text-amber-600 hover:bg-amber-200 transition">
                                    Edit
                                </a>

                                <form action="{{ route('activity.destroy', $activity) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus aktivitas ini?')">
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
                        <td colspan="7" class="p-8 text-center text-gray-500">
                            Belum ada data aktivitas
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="p-4">
  {{ $activities->links() }}
</div>
@endsection
