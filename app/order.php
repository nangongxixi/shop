<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $table = 'order';
    protected $fillable = ['pay_type','receiver_name','receiver_province','receiver_city','receiver_district','receiver_detail','receiver_phone','receiver_email'];

}
