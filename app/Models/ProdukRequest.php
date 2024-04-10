<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukRequest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'produk_request';

    public function staff()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id', 'id');
    }
}

