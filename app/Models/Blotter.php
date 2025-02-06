<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blotter extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_number',
        'complainant_name',
        'complainant_address',
        'complainant_contact',
        'respondent_name',
        'respondent_address',
        'respondent_contact',
        'witnesses',
        'incident_details',
        'incident_date',
        'location',
        'status',
        'remarks',
        'recorded_by'
    ];

    protected $casts = [
        'incident_date' => 'datetime',
    ];

    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
