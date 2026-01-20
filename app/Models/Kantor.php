<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Kantor extends Model
{
    protected $connection= 'pgsql';
    protected $table = 'tbl_kantor';
    protected $primaryKey = 'kodekantor';
    public $incrementing = false;
    protected $keyType = 'string';
}
