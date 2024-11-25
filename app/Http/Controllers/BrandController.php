<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword', '');
        $brands = Brand::where('name', 'like', '%'.$keyword.'%')->orderBy('name')->paginate(4);
        return response()->json($brands);
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
                'name.required' => 'Nama brand wajib diisi.',
                'name.string' => 'Nama brand harus berupa teks.'
            ]);
            Brand::create($request->all()); //req semua fillable yang ada di model
            return response()->json(['message' => 'Brand berhasil disimpan'], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = Brand::findOrFail($id);
        return response()->json($brand);
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
                'name.required' => 'Nama Brand wajib diisi.',
                'name.string' => 'Nama Brand harus berupa teks.'
            ]);
            $brand = Brand::findOrFail($id); //findOrFail untuk ngecek apakah id nya sudah sama dengan id target
            $brand->update($request->all());
            return response()->json(['message' => 'Brand berhasil diupdate'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return response()->json(['message' => 'Brand berhasil dihapus'], 200);
    } 
}
