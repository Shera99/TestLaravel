<?php

namespace App\Http\Controllers;

use App\Enums\ProjectStatus;
use App\Http\Requests\ProjectUpdateRequest;
use App\Services\ProjectService;
use App\Models\Project;

class ProjectController extends Controller
{
    protected ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->middleware('auth');
        $this->projectService = $projectService;
    }

    public function index()
    {
        $projects = Project::get();

        return view('projects.index', ['projects' => $projects]);
    }

    public function show(string $uuid)
    {
        $data = $this->projectService->getProjectData($uuid);

        return view('projects.show', $data);
    }

    public function edit(string $uuid)
    {
        $project = $this->projectService->getProjectAndCkeck($uuid);
        $statuses = ProjectStatus::values();

        return view('projects.edit', ["project" => $project, 'statuses' => $statuses]);
    }

    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $project->update($request->validated());

        return redirect(route("project.show", ['uuid' => $project->uuid]));
    }
}
