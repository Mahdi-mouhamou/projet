<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Journal extends Model
{
    protected $fillable = ['data','user','date','operation','model']; 
}
