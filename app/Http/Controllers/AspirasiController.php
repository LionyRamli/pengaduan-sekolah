<?php

namespace App\Http\Controllers;
use App\Models\Aspirasi;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    public function show($id){
        $back_aspirasis = Aspirasi::find($id);
        return view ('iaspirasi.create', compact('back_aspirasis'));
    }//
}
