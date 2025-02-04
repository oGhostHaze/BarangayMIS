<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $fillable = [
        'barangay_name',
        'municipal_name',
        'province_name',
        'provincial_logo',
        'barangay_logo',
        'additional_logo',
    ];
}