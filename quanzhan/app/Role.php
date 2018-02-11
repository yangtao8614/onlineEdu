<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    public $timestamps  = false;
    protected $fillable = ['role_name','priv_ids','priv_ac'];

}
