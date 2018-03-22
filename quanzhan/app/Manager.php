<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Manager extends Authenticatable
{
    protected $table = 'manager';
    protected $fillable = ['username','password','email','city','address','intro','company','phone','role_id'];
    public function  role(){
        return $this->hasOne('App\Role','id','role_id');
    }
}
