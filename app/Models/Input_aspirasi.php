<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Input_aspirasi extends Model
{
    protected $guarded = [];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function kategori(){
        return $this->hasOne(Kategori::class,'id','kategori_id');
    }
    public function aspirasi(){
        return $this->hasOne(Aspirasi::class);
    }
}
