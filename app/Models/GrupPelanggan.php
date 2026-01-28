<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class GrupPelanggan extends Model
{
    protected $connection= 'pgsql';
    protected $table = 'tbl_supelgrup';
    protected $primaryKey = 'kgrup';
    public $incrementing = false;
    protected $keyType = 'string';
}
