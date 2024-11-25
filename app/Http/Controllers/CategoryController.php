<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword', '');
        $categories = Category::where('name', 'like', '%'.$keyword.'%')->orderBy('name')->paginate(4);
        return response()->json($categories);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string'
            ],
            [
                'name.required' => 'Nama category wajib diisi.',
                'name.string' => 'Nama category harus berupa teks.'
            ]);
            Category::create($request->all()); //req semua fillable yang ada di model
            return response()->json(['message' => 'Category berhasil disimpan'], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required'
            ],
            [
                'name.required' => 'Nama category wajib diisi.',
                'name.string' => 'Nama category harus berupa teks.'
            ]);
            $category = Category::findOrFail($id); //findOrFail untuk ngecek apakah id nya sudah sama dengan id target
            $category->update($request->all());
            return response()->json(['message' => 'Category berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category berhasil dihapus'], 200);
    }
}
