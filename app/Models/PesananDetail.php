<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    public function jasa()
    {
        return $this->belongsTo('App\Jasa', 'jasa_id', 'id');
    }

    public function pesanan()
    {
        return $this->belongsTo('App\Pesanan', 'pesanan_id', 'id');
    }
}
