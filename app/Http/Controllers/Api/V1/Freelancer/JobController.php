<?php

namespace App\Http\Controllers\Api\V1\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobVacancy as Job;
use App\Http\Resources\JobResource;
use App\Services\JobService;

class JobController extends Controller
{
    public function __construct(private JobService $service) {}

    public function index()
    {
        $jobs = $this->service->listPublishedJobs();
        return JobResource::collection($jobs);
    }

    public function show(Job $job)
    {
        abort_unless($job->status === 'published', 404);
        return new JobResource($job);
    }
}
