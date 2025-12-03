<?php

namespace App\Services;

use App\Models\Application;
use App\Models\JobVacancy as Job;
use App\Models\User;

class ApplicationService
{
    public function apply(Job $job, User $freelancer, array $data): Application
    {
        $path = $data['cv']->store('cvs', 'public');

        return Application::create([
            'job_vacancy_id'=> $job->id,
            'freelancer_id' => $freelancer->id,
            'cv_path'       => $path,
            'cover_letter'  => $data['cover_letter'] ?? null,
        ]);
    }

    public function listJobApplications(Job $job)
    {
        return $job->applications()->with('freelancer')->latest()->paginate();
    }
}
