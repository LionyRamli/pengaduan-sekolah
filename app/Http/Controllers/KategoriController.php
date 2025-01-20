<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view ('kategori.index', compact('kategoris'));
    }
    /**
     * Show the form for creating a new resource.
     */
    
    public function create()
    {
        return view ('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'keterangan'=> 'required'
        ]);
        
        Kategori::create([
            'keterangan' => $request->get('keterangan')
        ]);

        return redirect()->route('kategori.index')->with('message', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
        'keterangan' => 'required',
    ]);
    
    $kategori = Kategori::findOrFail($id);
    $kategori->update([
        'keterangan' => $request->get('keterangan')
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('kategori.index')->with('message', 'Kategori berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {   
        $kategori->delete();
        return redirect()->route('kategori.index')->with('message', 'Kategori berhasil dihapus');
    }

}
