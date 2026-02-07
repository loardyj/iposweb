<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $connection= 'pgsql';
    protected $table = 'tbl_item';
    protected $primaryKey = 'kodeitem';
    public $incrementing = false;
    protected $keyType = 'string';

    public function harga_jual()
    {
        return $this->hasMany(HargaJual::class, 'kodeitem', 'kodeitem');
    }

    public function stok()
    {
        return $this->hasMany(ItemStok::class, 'kodeitem', 'kodeitem');
    }
}
