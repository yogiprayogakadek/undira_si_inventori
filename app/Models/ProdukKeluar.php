<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukKeluar extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'produk_keluar';

    protected function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}
