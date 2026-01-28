<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Keranjang extends Model
{
    protected $table = 'keranjang';

    public $timestamps = false;

    protected $fillable = [
        'kode_supel'
    ];

    public function details(): HasMany
    {
        return $this->hasMany(KeranjangDetail::class);
    }
}
