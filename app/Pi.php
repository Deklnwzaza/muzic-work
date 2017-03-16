<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pi extends Model
{
    public $timestamps = true;
    protected $table = 'pi_datas';
    protected $fillable = [];
}
