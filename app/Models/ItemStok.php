<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemStok extends Model
{
    protected $connection= 'pgsql';
    protected $table = 'tbl_itemstok';
    protected $primaryKey = null;
    public $incrementing = false;

    // public function harga_jual()
    // {
    //     return $this->hasMany(HargaJual::class, 'kodeitem', 'kodeitem');
    // }
}
