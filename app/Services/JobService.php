<?php

namespace App\Services;

use App\Models\JobVacancy as Job;
use App\Models\User;

class JobService
{
    public function listEmployerJobs(User $employer)
    {
        return $employer->jobs()->latest()->paginate();
    }

    public function createJob(User $employer, array $data): Job
    {
        $data['employer_id'] = $employer->id;
        return Job::create($data);
    }

    public function updateJob(Job $job, array $data): Job
    {
        $job->update($data);
        return $job;
    }

    public function listPublishedJobs()
    {
        return Job::where('status', 'published')
            ->latest()
            ->paginate();
    }
}
