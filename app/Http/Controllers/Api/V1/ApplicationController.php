<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobVacancy as Job;
use App\Http\Requests\Application\StoreApplicationRequest;
use App\Http\Resources\ApplicationResource;
use App\Services\ApplicationService;

class ApplicationController extends Controller
{
    public function __construct(private ApplicationService $service) {}

    // freelancer apply job
    public function store(StoreApplicationRequest $request, Job $job)
    {
        $freelancer = $request->user();

        if ($freelancer->role !== 'freelancer') {
            return response()->json(['message' => 'Only freelancer can apply'], 403);
        }

        $application = $this->service->apply($job, $freelancer, $request->validated());

        return new ApplicationResource($application);
    }

    // employer lihat CV dari job tertentu
    public function index(Job $job, Request $request)
    {
        if ($request->user()->id !== $job->employer_id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $apps = $this->service->listJobApplications($job);
        return ApplicationResource::collection($apps);
    }
}
