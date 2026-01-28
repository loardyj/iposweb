<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;

class KeranjangDetail extends Model
{
    protected $table = 'keranjang_detail';

    public $timestamps = false;

    protected $fillable = [
        'keranjang_id',
        'kode_item',
        'qty'
    ];

    public function item_details()
    {
        return $this->hasOne(Item::class, 'kodeitem', 'kode_item');
    }
}
