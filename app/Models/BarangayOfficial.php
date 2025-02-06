<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangayOfficial extends Model
{
    public $fillable = ['first_name', 'last_name', 'middle_name', 'position', 'status'];
}
