<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\ProductImages;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $query = Product::query();
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%')
                ->orWhere('short_description', 'like', '%' . $search . '%')
                ->orWhere('long_description', 'like', '%' . $search . '%');
        }

        $products = $query->paginate(5);
        // return response()->json(ProductResource::collection($products));
        return Inertia::render('Products/Index', [
            'products' => ProductResource::collection($products),
            'filters' => $request->only(['search']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Products/Create',[
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:100|unique:products,code',
            'short_description' => 'required|string|max:500',
            'long_description' => 'required|string',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->code = $request->code;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->purchase_price = $request->purchase_price;
        $product->sale_price = $request->sale_price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->save();

        return to_route('admin.products.index')
            ->with("message", "Producto creado exitosamente")
            ->with("icon", "success");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return Inertia::render('Products/Show',[
            'product' => new ProductResource($product)
        ]);
    }

    public function images (string $id)
    {
        $product = Product::findOrFail($id);
        return Inertia::render('Products/Images',[
            'product' => new ProductResource($product)
        ]);
    }

    public function uploadImage(Request $request, string $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $product = Product::findOrFail($id);

        $productImage = new ProductImages();
        $productImage->product_id = $product->id;
        $productImage->image = $request->file('image')->store('products', 'public');
        $productImage->save();

        return to_route('admin.products.images', $product->id)
            ->with('message', 'Imagen subida exitosamente' )
            ->with('icon', 'success');
    }

    public function deleteImage(string $id)
    {
        $productImage = ProductImages::findOrFail($id);
        $product_id = $productImage->product_id;
        if ($productImage->image && Storage::disk('public')->exists($productImage->image)){
            Storage::disk('public')->delete($productImage->image);
        }
        $productImage->delete();

        return to_route('admin.products.images', $product_id)
            ->with('message', 'Imagen eliminada exitosamente' )
            ->with('icon', 'success');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
