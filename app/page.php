<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class page extends Model
{
    protected $table = 'page';
    protected $fillable = ['title', 'content', 'coverPic'];
}
