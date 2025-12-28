<?php

namespace App\Http\Controllers;

use App\Models\RumahSakit;
use Illuminate\Http\Request;

class RumahSakitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rumahSakits = RumahSakit::latest()->paginate(10);
        return view('rumah-sakit.index', compact('rumahSakits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rumah-sakit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:20',
        ]);

        RumahSakit::create($request->all());

        return redirect()->route('rumah-sakit.index')
            ->with('success', 'Data Rumah Sakit berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RumahSakit $rumahSakit)
    {
        return view('rumah-sakit.edit', compact('rumahSakit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RumahSakit $rumahSakit)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:20',
        ]);

        $rumahSakit->update($request->all());

        return redirect()->route('rumah-sakit.index')
            ->with('success', 'Data Rumah Sakit berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage (AJAX).
     */
    public function destroy(RumahSakit $rumahSakit)
    {
        try {
            $rumahSakit->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data Rumah Sakit berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data. Pastikan tidak ada pasien yang terkait.'
            ], 500);
        }
    }
}
