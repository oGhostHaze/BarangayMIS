<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;
    protected $fillable = [
        'last_name', 'first_name', 'middle_name', 'suffix', 'prefix', 'contact_no', 'sitio',
        'date_of_birth', 'gender', 'civil_status', 'philhealth_id', 'sss_id', 'gsis_id', 'social_pension_id',
        'is_pwd', 'pwd_id', 'type_of_disability', 'illness', 'is_solo_parent', 'solo_parent_id',
        'is_senior_citizen', 'senior_citizen_id', 'educational_attainment', 'source_of_income',
        'monthly_income', 'income_type', 'is_ofw', 'ofw_country', 'ofw_is_domestic_helper', 'ofw_professional'
    ];
    public function medications() {
        return $this->hasMany(Medication::class);
    }
}