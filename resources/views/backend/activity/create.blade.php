@extends('backend.layouts.index')

@section('title', 'Tambah Aktivitas')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">
            Tambah Aktivitas
        </h1>
        <p class="text-sm text-gray-500">
            Buat berita / kegiatan baru
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <form action="{{ route('activity.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @csrf

            <!-- LEFT -->
            <div class="space-y-5">
                <!-- JUDUL -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Judul Aktivitas
                    </label>
                    <input type="text"
                           name="title"
                           required
                           class="w-full rounded-lg px-4 py-2 border border-slate-300
                                  focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <!-- TANGGAL -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tanggal Kegiatan
                    </label>
                    <input type="date"
                           name="activity_date"
                           class="w-full rounded-lg px-4 py-2 border border-slate-300">
                </div>

                <!-- LOKASI -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Lokasi
                    </label>
                    <input type="text"
                           name="location"
                           placeholder="Contoh: Candi Borobudur"
                           class="w-full rounded-lg px-4 py-2 border border-slate-300">
                </div>

                <!-- STATUS -->
                <div class="flex items-center gap-3 pt-2">
                    <input type="checkbox"
                           name="is_active"
                           value="1"
                           checked
                           class="w-4 h-4 text-indigo-600 border-gray-300 rounded">
                    <label class="text-sm text-gray-700">
                        Aktifkan aktivitas
                    </label>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="space-y-5">
                <!-- COVER -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                      Cover Image
                  </label>
                  <button type="button"
                          onclick="document.getElementById('coverInput').click()"
                          class="w-full px-4 py-3 border-2 border-dashed border-slate-300
                                rounded-xl text-sm text-slate-500
                                hover:bg-slate-50 transition text-center">
                      Klik untuk upload cover image
                  </button>
                  <input type="file"
                        id="coverInput"
                        name="cover_image"
                        accept="image/*"
                        onchange="previewCover(event)"
                        class="hidden">
                  <img id="coverPreview"
                      class="hidden mt-3 w-full h-48 object-cover rounded-lg border">
              </div>

                <!-- CONTENT -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Isi Aktivitas
                    </label>
                    <textarea name="content"
                              rows="6"
                              required
                              class="w-full rounded-lg px-4 py-2 border border-slate-300
                                     focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                </div>

                <!-- MULTI IMAGE -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Gambar Kegiatan (bisa banyak)
                    </label>

                    <button type="button"
                            onclick="document.getElementById('imagesInput').click()"
                            class="px-4 py-2 text-sm rounded-lg border border-slate-300 hover:bg-slate-100">
                        + Pilih Gambar
                    </button>

                    <input type="file"
                           id="imagesInput"
                           name="images[]"
                           multiple
                           accept="image/*"
                           class="hidden">

                    <!-- PREVIEW -->
                    <div id="previewContainer"
                         class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                    </div>
                </div>
            </div>

            <!-- ACTION -->
            <div class="lg:col-span-2 flex gap-3 pt-4">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-lg shadow">
                    Simpan
                </button>

                <a href="{{ route('activity.index') }}"
                   class="px-6 py-2.5 rounded-lg border border-slate-300 text-gray-700 hover:bg-slate-100">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const imagesInput = document.getElementById('imagesInput');
    const previewContainer = document.getElementById('previewContainer');
    let filesBuffer = [];

    imagesInput.addEventListener('change', function (e) {
        const newFiles = Array.from(e.target.files);
        newFiles.forEach(file => filesBuffer.push(file));
        renderPreviews();
        rebuildInputFiles();
    });

    function renderPreviews() {
        previewContainer.innerHTML = '';

        filesBuffer.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const div = document.createElement('div');
                div.className = 'relative group';

                div.innerHTML = `
                    <img src="${e.target.result}"
                         class="w-full h-32 object-cover rounded-lg border">

                    <button type="button"
                            onclick="removeImage(${index})"
                            class="absolute top-1 right-1 bg-black/60 text-white
                                   rounded-full w-6 h-6 flex items-center justify-center
                                   opacity-0 group-hover:opacity-100 transition">
                        ✕
                    </button>
                `;
                previewContainer.appendChild(div);
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
        const dataTransfer = new DataTransfer();
        filesBuffer.forEach(file => dataTransfer.items.add(file));
        imagesInput.files = dataTransfer.files;
    }

    function previewCover(event) {
        const img = document.getElementById('coverPreview');
        if (!event.target.files || !event.target.files[0]) return;

        img.src = URL.createObjectURL(event.target.files[0]);
        img.classList.remove('hidden');
    }
</script>
@endpush
