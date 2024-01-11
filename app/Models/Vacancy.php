<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_id',
        'status',
        'start_date',
        'end_date',
        'description',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
