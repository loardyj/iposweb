<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $connection= 'pgsql';
    protected $table = 'tbl_ikhd';
    protected $primaryKey = 'notransaksi';
    public $incrementing = false;
    protected $keyType = 'string';
}
