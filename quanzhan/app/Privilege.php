<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    protected $table = 'privilege';
    public $timestamps = false;
    protected $fillable = ['priv_name','parent_id','controller_name','action_name','level_name','address'];
}
