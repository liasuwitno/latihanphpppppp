<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');  // Default to empty string if no keyword is provided
        $categoryName = $request->get('category_name');
        $brandName = $request->get('brand_name');

        $query = Product::query();

        if ($keyword) {
            $query = $query->where('name', 'like', "%{$keyword}%");
        }

        if ($categoryName) {
            $query->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->where('categories.name', 'like', "%{$categoryName}%");
        }

        if ($brandName) {
            $query->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.*', 'brands.name as brand_name')
            ->where('brands.name', 'like', "%{$brandName}%");
        }
        $products = $query->orderBy('name')->paginate(10);
    
        // Fetch all brands and categories
        // $brands = Brand::all();
        // $categories = Category::all();
    
        // Return the response as JSON
        return response()->json([
            'products' => $products,
            // 'brands' => $brands,
            // 'categories' => $categories,
            'query' => $query->toSql(), // cara menampilkan query nya
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            ],
            [
                'name.required' => 'Nama produk wajib diisi.',
                'name.string' => 'Nama produk harus berupa teks.',
                'name.max' => 'Nama produk maksimal 50 karakter.',
                'price.required' => 'Harga produk wajib diisi.',
                'price.numeric' => 'Harga produk harus berupa angka.',
                'stock.required' => 'Stok produk wajib diisi.',
                'stock.integer' => 'Stok produk harus berupa bilangan bulat.',
            ]);
            Product::create($request->all()); //req semua fillable yang ada di model
            return response()->json(['message' => 'Produk berhasil disimpan'], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            ],
            [
                'name.required' => 'Nama produk wajib diisi.',
                'name.string' => 'Nama produk harus berupa teks.',
                'name.max' => 'Nama produk maksimal 50 karakter.',
                'price.required' => 'Harga produk wajib diisi.',
                'price.numeric' => 'Harga produk harus berupa angka.',
                'stock.required' => 'Stok produk wajib diisi.',
                'stock.integer' => 'Stok produk harus berupa bilangan bulat.',
            ]);
            $product = Product::findOrFail($id); //findOrFail untuk ngecek apakah id nya sudah sama dengan id target
            $product->update($request->all());
            return response()->json(['message' => 'Produk berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Produk berhasil dihapus'], 200);
    }
}
