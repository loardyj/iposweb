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

    protected $table2 = 'tbl_itemhj';
}
