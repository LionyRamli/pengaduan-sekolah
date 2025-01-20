<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Input_aspirasi;
class Aspirasi extends Model
{
    protected $guarded = [];
    public function inputaspirasi()
    {
        return $this->belongsTo(Input_aspirasi::class);
    }
}
