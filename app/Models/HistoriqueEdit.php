<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class HistoriqueEdit extends Model
{
    protected $fillable = ['data','user','date','operation','model']; 
}
