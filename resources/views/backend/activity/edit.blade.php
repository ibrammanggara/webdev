@extends('backend.layouts.index')

@section('title', 'Edit Aktivitas')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Edit Aktivitas</h1>
        <p class="text-sm text-gray-500">Perbarui data aktivitas</p>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        {{-- FORM EDIT UTAMA --}}
        <form action="{{ route('activity.update', $activity) }}"
              method="POST"
              enctype="multipart/form-data"
              class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @csrf
            @method('PUT')

            {{-- LEFT --}}
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                    <input type="text" name="title"
                           value="{{ old('title', $activity->title) }}"
                           required
                           class="w-full rounded-lg px-4 py-2 border border-slate-300">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="activity_date"
                           value="{{ old('activity_date', optional($activity->activity_date)->format('Y-m-d')) }}"
                           class="w-full rounded-lg px-4 py-2 border border-slate-300">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                    <input type="text" name="location"
                           value="{{ old('location', $activity->location) }}"
                           class="w-full rounded-lg px-4 py-2 border border-slate-300">
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', $activity->is_active) ? 'checked' : '' }}>
                    <label class="text-sm text-gray-700">Aktifkan aktivitas</label>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="space-y-5">
                {{-- COVER --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cover Image</label>
                    <button type="button"
                            onclick="document.getElementById('coverInput').click()"
                            class="w-full px-4 py-3 border-2 border-dashed rounded-xl text-sm text-slate-500">
                        Klik untuk ganti cover
                    </button>
                    <input type="file" id="coverInput" name="cover_image"
                           accept="image/*" onchange="previewCover(event)" class="hidden">
                    <img id="coverPreview"
                         src="{{ $activity->cover_image ? asset('storage/'.$activity->cover_image) : '' }}"
                         class="mt-3 w-full h-48 object-cover rounded-lg border
                                {{ $activity->cover_image ? '' : 'hidden' }}">
                </div>

                {{-- CONTENT --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Isi Aktivitas</label>
                    <textarea name="content" rows="6" required
                              class="w-full rounded-lg px-4 py-2 border border-slate-300">{{ old('content', $activity->content) }}</textarea>
                </div>

                {{-- GAMBAR LAMA --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Lama</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($activity->images as $img)
                            <div class="relative group">
                                <img src="{{ asset('storage/'.$img->image) }}"
                                     class="w-full h-32 object-cover rounded-lg border">
                                <button type="button"
                                        onclick="deleteImage('{{ route('activity.image.destroy', $img) }}')"
                                        class="absolute top-1 right-1 bg-black/60 text-white
                                               w-6 h-6 rounded-full opacity-0 group-hover:opacity-100">
                                    ✕
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- GAMBAR BARU --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tambah Gambar Baru</label>
                    <button type="button"
                            onclick="document.getElementById('imagesInput').click()"
                            class="px-4 py-2 text-sm rounded-lg border">
                        + Pilih Gambar
                    </button>

                    <input type="file" id="imagesInput" name="images[]" multiple
                           accept="image/*" class="hidden">

                    <div id="previewContainer"
                         class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4"></div>
                </div>
            </div>

            {{-- ACTION --}}
            <div class="lg:col-span-2 flex gap-3 pt-4">
                <button type="submit"
                        class="relative z-10 bg-indigo-600 text-white px-6 py-2.5 rounded-lg">
                    Update
                </button>

                <a href="{{ route('activity.index') }}"
                   class="px-6 py-2.5 rounded-lg border">Batal</a>
            </div>
        </form>
    </div>
</div>

{{-- FORM HAPUS GAMBAR (DI LUAR FORM EDIT) --}}
<form id="deleteImageForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
    function previewCover(event) {
        const img = document.getElementById('coverPreview');
        if (!event.target.files[0]) return;
        img.src = URL.createObjectURL(event.target.files[0]);
        img.classList.remove('hidden');
    }

    function deleteImage(url) {
        if (!confirm('Hapus gambar ini?')) return;
        const form = document.getElementById('deleteImageForm');
        form.action = url;
        form.submit();
    }

    // MULTI IMAGE BUFFER
    const imagesInput = document.getElementById('imagesInput');
    const previewContainer = document.getElementById('previewContainer');
    let filesBuffer = [];

    if (imagesInput) {
        imagesInput.addEventListener('change', function () {
            Array.from(imagesInput.files).forEach(f => filesBuffer.push(f));
            renderPreviews();
            rebuildInputFiles();
        });
    }

    function renderPreviews() {
        previewContainer.innerHTML = '';
        filesBuffer.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = e => {
                previewContainer.innerHTML += `
                    <div class="relative">
                        <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg border">
                        <button type="button"
                                onclick="removeImage(${index})"
                                class="absolute top-1 right-1 bg-black/60 text-white w-6 h-6 rounded-full">
                            ✕
                        </button>
                    </div>`;
            };
            reader.readAsDataURL(file);
        });
    }

    function removeImage(index) {
        filesBuffer.splice(index, 1);
        renderPreviews();
        rebuildInputFiles();
    }

    function rebuildInputFiles() {
        const dt = new DataTransfer();
        filesBuffer.forEach(f => dt.items.add(f));
        imagesInput.files = dt.files;
    }
</script>
@endpush
