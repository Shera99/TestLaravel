@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Project</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                            @php
                                $role = $project->getRole(auth()->user());
                            @endphp
                            @if(!empty($role))
                                <td><a href="{{ route('project.show', ['uuid' => $project->uuid]) }}">{{ $project->name }}</td>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
