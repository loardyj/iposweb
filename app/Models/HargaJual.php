<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class HargaJual extends Model
{
    protected $connection= 'pgsql';
    protected $table = 'tbl_itemhj';
    protected $primaryKey = 'iddetail';
    public $incrementing = false;
    protected $keyType = 'string';
}
