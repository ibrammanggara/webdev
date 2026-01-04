@extends('backend.layouts.index')

@section('title', 'Tambah Galeri')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">
            Tambah Galeri
        </h1>
        <p class="text-sm text-gray-500">
            Upload gambar untuk ditampilkan di galeri
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <form action="{{ route('gallery.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Gambar Galeri
                </label>

                <label
                    class="flex flex-col items-center justify-center w-full h-72 border-2 border-dashed rounded-xl cursor-pointer
                           hover:bg-slate-50 transition
                           {{ $errors->has('image') ? 'border-rose-400' : 'border-slate-300' }}">
                    
                    <div class="flex flex-col items-center gap-2 text-slate-500" id="uploadPlaceholder">
                        <svg class="w-10 h-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 16.5v-9m0 0L8.25 11.25M12 7.5l3.75 3.75M3 15.75V19.5A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 19.5v-3.75"/>
                        </svg>
                        <p class="text-sm">
                            Klik untuk upload gambar
                        </p>
                        <p class="text-xs text-slate-400">
                            JPG, PNG (max 2MB)
                        </p>
                    </div>

                    <img id="imagePreview"
                         class="hidden w-full h-full object-cover rounded-xl">

                    <input type="file"
                           name="image"
                           accept="image/*"
                           class="hidden"
                           onchange="previewImage(event)">
                </label>

                @error('image')
                    <p class="text-sm text-rose-600 mt-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex flex-col justify-between">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Judul (Opsional)
                    </label>

                    <input type="text"
                           name="title"
                           value="{{ old('title') }}"
                           placeholder="Contoh: Kegiatan Upacara"
                           class="w-full rounded-lg px-4 py-2 border border-slate-300
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500">

                    @error('title')
                        <p class="text-sm text-rose-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex items-center gap-3 mt-4">
                    <input type="checkbox"
                          name="is_active"
                          value="1"
                          checked
                          class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">

                    <label class="text-sm text-gray-700">
                        Tampilkan galeri
                    </label>
                </div>

                <div class="flex gap-3 mt-6">
                    <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-lg shadow transition">
                        Simpan
                    </button>

                    <a href="{{ route('gallery.index') }}"
                       class="px-6 py-2.5 rounded-lg border border-slate-300 text-gray-700 hover:bg-slate-100 transition">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(event) {
        const input = event.target;
        const img = document.getElementById('imagePreview');
        const placeholder = document.getElementById('uploadPlaceholder');

        if (!input.files || !input.files[0]) {
            img.src = '';
            img.classList.add('hidden');
            placeholder.classList.remove('hidden');
            return;
        }

        img.src = URL.createObjectURL(input.files[0]);
        img.classList.remove('hidden');
        placeholder.classList.add('hidden');
    }
</script>
@endpush
