<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DurianData extends Model
{
    public $timestamps = true;
    protected $table = 'durian_datas';
    protected $fillable = ['num', 'image'];
}
