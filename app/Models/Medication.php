<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medication extends Model
{
    use HasFactory;
    protected $fillable = ['resident_id', 'medication_name', 'dosage', 'instructions', 'prescribed_date'];
    public function resident() {
        return $this->belongsTo(Resident::class);
    }
}