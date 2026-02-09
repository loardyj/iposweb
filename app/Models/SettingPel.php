<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingPel extends Model
{
    protected $connection= 'pgsql';
    protected $table = 'tbl_settingpel';
    protected $primaryKey = null;
    public $incrementing = false;
}
