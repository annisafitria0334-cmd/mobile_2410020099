<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Daftar produk',
            'data'    => Produk::all(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'kode'        => 'required|string|max:10|unique:produk,kode',
            'id_kategori' => 'required|string|max:20',
            'nama_produk' => 'required|string|max:30',
            'harga_beli'  => 'required|integer|min:0',
            'harga_jual'  => 'required|integer|min:0',
        ]);

        $produk = Produk::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan',
            'data'    => $produk,
        ], 201);
    }

    public function show(Produk $produk): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail produk',
            'data'    => $produk,
        ]);
    }

    public function update(Request $request, Produk $produk): JsonResponse
    {
        // kode adalah primary key, jadi tidak diubah lewat update
        $data = $request->validate([
            'id_kategori' => 'sometimes|required|string|max:20',
            'nama_produk' => 'sometimes|required|string|max:30',
            'harga_beli'  => 'sometimes|required|integer|min:0',
            'harga_jual'  => 'sometimes|required|integer|min:0',
        ]);

        $produk->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil diubah',
            'data'    => $produk,
        ]);
    }

    public function destroy(Produk $produk): JsonResponse
    {
        $produk->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus',
        ]);
    }
}
