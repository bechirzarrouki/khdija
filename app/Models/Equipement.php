<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipement extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'equipements';
    protected $fillable = ['name', 'description','da','df'];

    protected $dates = ['deleted_at'];
    
}
