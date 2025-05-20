<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;
    protected $fillable = [
        'rfid_number', // Added RFID number field
        'last_name',
        'first_name',
        'middle_name',
        'suffix',
        'prefix',
        'contact_no',
        'sitio',
        'house_no',
        'date_of_birth',
        'gender',
        'civil_status',
        'philhealth_id',
        'sss_id',
        'gsis_id',
        'social_pension_id',
        'is_pwd',
        'pwd_id',
        'type_of_disability',
        'illness',
        'is_solo_parent',
        'solo_parent_id',
        'is_senior_citizen',
        'senior_citizen_id',
        'educational_attainment',
        'source_of_income',
        'monthly_income',
        'income_type',
        'is_ofw',
        'ofw_country',
        'ofw_is_domestic_helper',
        'ofw_professional',
        'email',
        'user_id',
        'valid_id_path', // Added valid ID file path
        'valid_id_type', // Added valid ID type
    ];

    public function medications()
    {
        return $this->hasMany(Medication::class);
    }

    public function age()
    {
        return Carbon::parse($this->date_of_birth)->age;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function certificateRequests()
    {
        return $this->hasMany(CertificateRequest::class);
    }

    // Get all blotter cases where this resident is the complainant or respondent
    public function blotterCases()
    {
        return Blotter::where('complainant_name', 'LIKE', "%{$this->first_name}%{$this->last_name}%")
            ->orWhere('respondent_name', 'LIKE', "%{$this->first_name}%{$this->last_name}%")
            ->get();
    }

    public function pendingBlotterCases()
    {
        return Blotter::where('resident_id', "{$this->id}")->where('status', 'Pending')
            ->count();
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . ($this->middle_name ? substr($this->middle_name, 0, 1) . '. ' : '') . $this->last_name . ($this->suffix ? ' ' . $this->suffix : '');
    }

    public function getAddressAttribute()
    {
        return ('Sitio: ' . $this->sitio . ' ') . $this->house_no ? (', House # ' . $this->house_no) : '';
    }
}
