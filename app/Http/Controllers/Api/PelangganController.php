<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Daftar pelanggan',
            'data'    => Pelanggan::all(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nama'   => 'required|string|max:25',
            'alamat' => 'required|string|max:30',
            'no_tlp' => 'required|digits_between:8,13',
        ]);

        $pelanggan = Pelanggan::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Pelanggan berhasil ditambahkan',
            'data'    => $pelanggan,
        ], 201);
    }

    public function show(Pelanggan $pelanggan): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail pelanggan',
            'data'    => $pelanggan,
        ]);
    }

    public function update(Request $request, Pelanggan $pelanggan): JsonResponse
    {
        $data = $request->validate([
            'nama'   => 'sometimes|required|string|max:25',
            'alamat' => 'sometimes|required|string|max:30',
            'no_tlp' => 'sometimes|required|digits_between:8,13',
        ]);

        $pelanggan->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Pelanggan berhasil diubah',
            'data'    => $pelanggan,
        ]);
    }

    public function destroy(Pelanggan $pelanggan): JsonResponse
    {
        $pelanggan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pelanggan berhasil dihapus',
        ]);
    }
}
