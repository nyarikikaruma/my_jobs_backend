<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'job_type',
        'company',
        'location',
        'salary',
        'experience',
        'expires_at',
        'description',
        'requirements',
        'what_you_will_do',
        'nice_to_have',
    ];
}
