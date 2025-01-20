<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::all();
        return view ('siswa.index', compact('siswas'));
    }
    /**
     * Show the form for creating a new resource.
     */
    // public function admin(){
    //     $pengaduans = Pengaduan::with('user')->get();
    //     return view ('pengaduan.index', compact('pengaduans'));
    // }
    public function create()
    {
        return view ('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nis'=> 'required',
            'kelas'=> 'required'
        ]);
        
        Siswa::create([
            'nis' => $request->get('nis'), 
            'kelas' => $request->get('kelas')
        ]);

        return redirect()->route('siswa.index')->with('message', 'Siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nis)
    {
        $request->validate([
        'nis' => 'required',
        'kelas'=> 'required'
    ]);
    
    $siswa = Siswa::findOrFail($nis);
    $siswa->update([
        'nis' => $request->get('nis'),
        'kelas' => $request->get('kelas'), // Status default
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('siswa.index')->with('message', 'Siswa berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {   
        $siswa->delete();
        return redirect()->route('siswa.index')->with('message', 'Siswa berhasil dihapus');
    }

}
