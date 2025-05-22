<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PesananDetail;

class Jasa extends Model
{
    public function pesanan_detail()
    {
        return $this->hasMany(PesananDetail::class, 'jasa_id', 'id');
    }
}
