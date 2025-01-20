<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $primaryKey = 'nis';

    protected $guarded = [];
    public function inputaspirasi()
    {
        return $this->hasMany(Input_aspirasi::class);
    }
}
