<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Helpers\Helper;
use App\Models\User;
use App\Repositories\ProjectRepository;

class ProjectService
{
    protected ProjectRepository $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function getProjectData(string $uuid)
    {
        $project = $this->getProjectAndCkeck($uuid);

        $result = [
            "project" => $project,
            "members" => $project->members()->get(),
            "other_users" => User::whereNotIn('id', $project->pluckMembers())->get(),
            "role" => $project->getRole(auth()->user()),
            "roles" => UserRole::values(),
            "data" => Helper::getProjectStatusText($project->status),
        ];

        return $result;
    }

    public function getProjectAndCkeck(string $uuid)
    {
        $project = $this->projectRepository->getProjectByUuid($uuid);

        if (empty($project)) return redirect(route('home'));
        if (!$project->isMember(auth()->user())) return redirect(route('home'));

        return $project;
    }
}
