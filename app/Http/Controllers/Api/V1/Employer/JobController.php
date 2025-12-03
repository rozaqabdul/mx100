<?php

namespace App\Http\Controllers\Api\V1\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobVacancy as Job;
use App\Http\Requests\Job\StoreJobRequest;
use App\Http\Requests\Job\UpdateJobRequest;
use App\Http\Resources\JobResource;
use App\Services\JobService;

class JobController extends Controller
{
    public function __construct(private JobService $service) {}

    public function index(Request $request)
    {
        $jobs = $this->service->listEmployerJobs($request->user());
        return JobResource::collection($jobs);
    }

    public function store(StoreJobRequest $request)
    {
        $user = $request->user();

        abort_unless($user->hasRole('employer') && $user->company_id, 403);

        $job = $this->service->createJob($user, $request->validated());

        return new JobResource($job);
    }

    public function show(Job $job)
    {
        return new JobResource($job);
    }

    public function update(UpdateJobRequest $request, Job $job)
    {
        $job = $this->service->updateJob($job, $request->validated());
        return new JobResource($job);
    }
}

