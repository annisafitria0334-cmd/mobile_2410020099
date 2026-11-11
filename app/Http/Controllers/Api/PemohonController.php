<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pemohon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PemohonController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Daftar pemohon',
            'data'    => Pemohon::with('jenisAkta')->get(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'id_akta'       => 'required|exists:jenis_akta,id_akta',
            'nik_pemohon'   => 'required|digits:16|unique:pemohon,nik_pemohon',
            'nama_pemohon'  => 'required|string|max:100',
            'tgl_lahir'     => 'required|date',
            'tempat_lahir'  => 'required|string|max:100',
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'alamat'        => 'required|string',
            'no_hp'         => 'required|string|max:15',
            'username'      => 'required|string|max:50|unique:pemohon,username',
            'password'      => 'required|string|min:6',
        ]);

        $pemohon = Pemohon::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Pemohon berhasil ditambahkan',
            'data'    => $pemohon->load('jenisAkta'),
        ], 201);
    }

    public function show(Pemohon $pemohon): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail pemohon',
            'data'    => $pemohon->load('jenisAkta'),
        ]);
    }

    public function update(Request $request, Pemohon $pemohon): JsonResponse
    {
        $data = $request->validate([
            'id_akta'       => 'sometimes|required|exists:jenis_akta,id_akta',
            'nik_pemohon'   => ['sometimes', 'required', 'digits:16',
                                Rule::unique('pemohon', 'nik_pemohon')->ignore($pemohon->id_pemohon, 'id_pemohon')],
            'nama_pemohon'  => 'sometimes|required|string|max:100',
            'tgl_lahir'     => 'sometimes|required|date',
            'tempat_lahir'  => 'sometimes|required|string|max:100',
            'jenis_kelamin' => ['sometimes', 'required', Rule::in(['Laki-laki', 'Perempuan'])],
            'alamat'        => 'sometimes|required|string',
            'no_hp'         => 'sometimes|required|string|max:15',
            'username'      => ['sometimes', 'required', 'string', 'max:50',
                                Rule::unique('pemohon', 'username')->ignore($pemohon->id_pemohon, 'id_pemohon')],
            'password'      => 'sometimes|required|string|min:6',
        ]);

        $pemohon->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Pemohon berhasil diubah',
            'data'    => $pemohon->load('jenisAkta'),
        ]);
    }

    public function destroy(Pemohon $pemohon): JsonResponse
    {
        $pemohon->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pemohon berhasil dihapus',
        ]);
    }
}
