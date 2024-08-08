<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = [
        'completion_date',
        'report_detail',
        'circuit_id',
        'report_status_id',
        //'created_at'
    ];

    function circuit(){
        return $this->belongsTo(Circuit::class);
    }
    function reportStatus(){
        return $this->belongsTo(ReportStatus::class);
    }
}
