<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class HistoriqueValidation extends Model
{
    protected $fillable = ['data','user','date','operation','model']; 
    
}
