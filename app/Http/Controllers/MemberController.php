<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\ProjectMemberAddRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\ProjectUserRole;
use Illuminate\Http\Request;
use App\Models\Project;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(ProjectMemberAddRequest $request)
    {
        $data = $request->validated();
        ProjectUserRole::create($data);
        return redirect()->back();
    }

    public function delete(int $id)
    {
        ProjectUserRole::where('id', $id)->delete();
        return redirect()->back();
    }
}
