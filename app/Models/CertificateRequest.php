<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CertificateRequest extends Model
{

    use HasFactory;

    protected $fillable = [
        'resident_id',
        'certificate_type',
        'purpose',
        'status',
        'control_number',
        'payment_method',
        'pickup_datetime',
        'receipt_path',
        'requested_at',
        'approved_at',
        'is_paid',
        'released_at',
        'processed_by',
        'barangay_official_id',
        'discount_type', // New field for discount type (Student, Senior Citizen, None)
        'discount_id_number', // New field for ID number verification
        'discount_amount', // New field for storing the discount amount
        'payment_status',          // unpaid, pending_verification, paid
        'payment_submitted_at',    // when payment was submitted
        'payment_verified_at',     // when payment was verified
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'approved_at' => 'datetime',
        'released_at' => 'datetime',
        'pickup_datetime' => 'datetime',
        'is_paid' => 'boolean',
        'payment_submitted_at' => 'datetime',
        'payment_verified_at' => 'datetime',
    ];

    public function resident() {
        return $this->belongsTo(Resident::class);
    }

    public function processedBy() {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function capt() {
        return $this->belongsTo(BarangayOfficial::class, 'barangay_official_id');
    }
}