<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'job_vacancy_id', 
        'freelancer_id',
        'cv_path',
        'cover_letter'
    ];

    public function job()
    {
        return $this->belongsTo(JobVacancy::class);
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }
}
