<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisAkta;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JenisAktaController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Daftar jenis akta',
            'data'    => JenisAkta::all(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nama_jenis' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $jenis = JenisAkta::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Jenis akta berhasil ditambahkan',
            'data'    => $jenis,
        ], 201);
    }

    public function show(JenisAkta $jenis_akta): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail jenis akta',
            'data'    => $jenis_akta->load('pemohon'),
        ]);
    }

    public function update(Request $request, JenisAkta $jenis_akta): JsonResponse
    {
        $data = $request->validate([
            'nama_jenis' => 'sometimes|required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $jenis_akta->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Jenis akta berhasil diubah',
            'data'    => $jenis_akta,
        ]);
    }

    public function destroy(JenisAkta $jenis_akta): JsonResponse
    {
        if ($jenis_akta->pemohon()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Jenis akta masih dipakai oleh pemohon, tidak bisa dihapus',
            ], 409);
        }

        $jenis_akta->delete();

        return response()->json([
            'success' => true,
            'message' => 'Jenis akta berhasil dihapus',
        ]);
    }
}
