<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::latest()->paginate(10);

        return view('backend.activity.index', compact('activities'));
    }

    public function create()
    {
        return view('backend.activity.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'content' => 'required',
            'activity_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload cover
        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')
                                 ->store('activities/covers', 'public');
        }

        $activity = Activity::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'cover_image' => $coverPath,
            'content' => $request->content,
            'activity_date' => $request->activity_date,
            'location' => $request->location,
            'is_active' => $request->has('is_active'),
        ]);

        // upload banyak gambar kegiatan
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('activities/images', 'public');

                ActivityImage::create([
                    'activity_id' => $activity->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()->route('activity.index')
            ->with('success', 'Aktivitas berhasil ditambahkan');
    }

    public function show(Activity $activity)
    {
        $activity->load('images');

        return view('backend.activity.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        $activity->load('images');

        return view('backend.activity.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'content' => 'required',
            'activity_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ganti cover
        if ($request->hasFile('cover_image')) {
            if ($activity->cover_image) {
                Storage::disk('public')->delete($activity->cover_image);
            }

            $activity->cover_image =
                $request->file('cover_image')->store('activities/covers', 'public');
        }

        $activity->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'activity_date' => $request->activity_date,
            'location' => $request->location,
            'is_active' => $request->has('is_active'),
        ]);

        // upload gambar tambahan
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('activities/images', 'public');

                ActivityImage::create([
                    'activity_id' => $activity->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()->route('activity.index')
            ->with('success', 'Aktivitas berhasil diperbarui');
    }

    /**
     * DELETE ACTIVITY
     */
    public function destroy(Activity $activity)
    {
        // hapus cover
        if ($activity->cover_image) {
            Storage::disk('public')->delete($activity->cover_image);
        }

        // hapus semua gambar kegiatan
        foreach ($activity->images as $img) {
            Storage::disk('public')->delete($img->image);
            $img->delete();
        }

        $activity->delete();

        return redirect()->route('activity.index')
            ->with('success', 'Aktivitas berhasil dihapus');
    }

    /**
     * DELETE SATU GAMBAR KEGIATAN
     */
    public function destroyImage(ActivityImage $image)
    {
        Storage::disk('public')->delete($image->image);
        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus');
    }
}
