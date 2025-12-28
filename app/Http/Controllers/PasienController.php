<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\RumahSakit;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rumahSakits = RumahSakit::all();
        
        $query = Pasien::with('rumahSakit');
        
        // Filter by rumah sakit if provided
        if ($request->has('rumah_sakit_id') && $request->rumah_sakit_id != '') {
            $query->where('rumah_sakit_id', $request->rumah_sakit_id);
        }
        
        $pasiens = $query->latest()->paginate(10);
        
        // Check if AJAX request for filter
        if ($request->ajax()) {
            return response()->json([
                'html' => view('pasien.partials.table', compact('pasiens'))->render(),
                'pagination' => $pasiens->links()->render()
            ]);
        }
        
        return view('pasien.index', compact('pasiens', 'rumahSakits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rumahSakits = RumahSakit::all();
        return view('pasien.create', compact('rumahSakits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'nullable|string|max:20',
            'rumah_sakit_id' => 'required|exists:rumah_sakits,id',
        ]);

        Pasien::create($request->all());

        return redirect()->route('pasien.index')
            ->with('success', 'Data Pasien berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pasien $pasien)
    {
        $rumahSakits = RumahSakit::all();
        return view('pasien.edit', compact('pasien', 'rumahSakits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'nullable|string|max:20',
            'rumah_sakit_id' => 'required|exists:rumah_sakits,id',
        ]);

        $pasien->update($request->all());

        return redirect()->route('pasien.index')
            ->with('success', 'Data Pasien berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage (AJAX).
     */
    public function destroy(Pasien $pasien)
    {
        try {
            $pasien->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data Pasien berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data.'
            ], 500);
        }
    }
}
