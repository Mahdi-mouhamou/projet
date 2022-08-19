<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class HistoriqueSup extends Model
{
    protected $fillable = ['data','user','date','operation','model']; 
}
