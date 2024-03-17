<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    public function getProjectByUuid(string $uuid)
    {
        return Project::query()->where('uuid', $uuid)->first();
    }
}
