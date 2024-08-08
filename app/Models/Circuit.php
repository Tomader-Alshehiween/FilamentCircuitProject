<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Circuit extends Model
{
    use HasFactory;
    protected $table = 'circuits';
    protected $fillable = [
        'circuit_number',
        'speed',
        'service_provider_id',
        'circuit_type_id',
        'entity_name_id',
        'circuit_status_id'
    ];

    public function serviceProvider(){
        return $this->belongsTo(ServiceProvider::class);
    }
    public function circuitType(){
        return $this->belongsTo(CircuitTypes::class);
    }
    public function circuitStatus(){
        return $this->belongsTo(CircuitStatus::class);
    }
    public function EntityName(){
        return $this->belongsTo(EntityName::class);
    }
}
