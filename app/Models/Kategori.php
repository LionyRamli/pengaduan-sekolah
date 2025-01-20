<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{

    protected $guarded = [];
    public function inputaspirasi()
    {
        return $this->belongsTo(Input_aspirasi::class);
    }
}
