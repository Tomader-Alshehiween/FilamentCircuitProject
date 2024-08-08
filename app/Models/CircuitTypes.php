<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CircuitTypes extends Model
{
    use HasFactory;
    protected $table = 'circuit_types';
    protected $fillable = ['circuit_type'];
}
