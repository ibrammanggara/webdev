<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);

        return view('backend.product.index', compact('products'));
    }

    public function create()
    {
        return view('backend.product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload cover
        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')
                ->store('products/covers', 'public');
        }

        $product = Product::create([
            'name' => $request->name,
            'slug' => SlugService::generate($request->name, Product::class),
            'cover_image' => $coverPath,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'stock' => $request->stock,
            'category' => $request->category,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        // upload banyak gambar produk
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('products/images', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()->route('product.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function show(Product $product)
    {
        $product->load('images');

        return view('backend.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $product->load('images');

        return view('backend.product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ganti cover
        if ($request->hasFile('cover_image')) {
            if ($product->cover_image) {
                Storage::disk('public')->delete($product->cover_image);
            }

            $product->cover_image = $request->file('cover_image')
                ->store('products/covers', 'public');
        }

        $product->update([
            'name' => $request->name,
            'slug' => SlugService::generate($request->name, Product::class, $product->id),
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'stock' => $request->stock,
            'category' => $request->category,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        // upload gambar tambahan
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('products/images', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }

        // HAPUS GAMBAR LAMA SETELAH KLIK UPDATE
        if ($request->filled('deleted_images')) {
            $ids = explode(',', $request->deleted_images);

            $images = ProductImage::whereIn('id', $ids)->get();

            foreach ($images as $img) {
                Storage::disk('public')->delete($img->image);
                $img->delete();
            }
        }

        return redirect()->route('product.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * DELETE PRODUCT
     */
    public function destroy(Product $product)
    {
        // hapus cover
        if ($product->cover_image) {
            Storage::disk('public')->delete($product->cover_image);
        }

        // hapus semua gambar produk
        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->image);
            $img->delete();
        }

        $product->delete();

        return redirect()->route('product.index')
            ->with('success', 'Produk berhasil dihapus');
    }

    /**
     * DELETE SATU GAMBAR PRODUK
     */
    public function destroyImage(ProductImage $image)
    {
        Storage::disk('public')->delete($image->image);
        $image->delete();

        return back()->with('success', 'Gambar produk berhasil dihapus');
    }
}
