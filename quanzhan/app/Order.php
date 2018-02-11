<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    public $timestamps = false;
    protected $fillable = ['order_sn','trade_sn','stu_id','total_price','pay_money','pay_time','pay_status'];
}
