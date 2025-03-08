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
        'payment_method',
        'pickup_datetime',
        'receipt_path',
        'requested_at',
        'approved_at',

        'is_paid',
        'released_at',
        'processed_by',
        'barangay_official_id',
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'approved_at' => 'datetime',
        'released_at' => 'datetime',
        'pickup_datetime' => 'datetime',
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