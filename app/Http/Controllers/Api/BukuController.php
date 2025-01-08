<?php

namespace App\Http\Controllers\Api;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Buku::orderBy("judul", "asc")->get();
        return response()->json([
            'status' => 'true',
            'message' => 'Data ditemukan',
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $dataBuku = new Buku;

        $rules = [
            'judul' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => 'Gagal memasukan data',
                'data' => $validator->errors(),
            ], 400);
        }

        $dataBuku->judul = $request->judul;
        $dataBuku->pengarang = $request->pengarang;
        $dataBuku->tahun_terbit = $request->tahun_terbit;

        $post = $dataBuku->save();

        return response()->json([
            'status' => 'true',
            'message' => 'Data berhasil disimpan',
            'data' => $dataBuku,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Buku::find($id);

        if ($data) {
            return response()->json([
                'status' => 'true',
                'message' => 'Data ditemukan',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => 'false',
                'message' => 'Data tidak ditemukan',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = Buku::find($id);
        if (empty($data)) {
            return response()->json([
                'status' => 'false',
                'message' => 'Gagal memperbarui data',
            ], 404);
        } else {
            $data->judul = $request->judul;
            $data->pengarang = $request->pengarang;
            $data->tahun_terbit = $request->tahun_terbit;
            $post = $data->save();
            return response()->json([
                'status' => 'true',
                'message' => 'Data berhasil diperbarui',
                'data' => $post,
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Buku::find($id);
        if (empty($data)) {
            return response()->json([
                'status' => 'false',
                'message' => 'Data tidak ditemukan',
            ], 404);
        } else {
            $post = $data->delete();
            return response()->json([
                'status' => 'true',
                'message' => 'Data berhasil dihapus',
                'data' => $post
            ], 200);
        }
    }
}