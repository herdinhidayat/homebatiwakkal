<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jasa;

class PesananDetail extends Model
{
    public function jasa()
    {
        return $this->belongsTo(Jasa::class, 'jasa_id', 'id');
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id', 'id');
    }
}
