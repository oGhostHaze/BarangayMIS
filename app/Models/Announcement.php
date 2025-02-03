<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
            "title",
            "excerpt",
            "content",
            "category",
            "image",
            "status",
            "published_at",
            "user_id",
    ];
}