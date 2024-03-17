@extends('layouts.app')

@section('content')
    <div class="container justify-content-center">
        <div class="card text-center">
            <div class="card-header {{ $data['class'] }}">
                {{ $data['text'] }}
            </div>
            <div class="card-body">
                <h5 class="card-title display-4">{{ $project->name }}</h5>
                <p class="card-text">{{ $project->description }}</p>
                @if(\App\Helpers\Helper::accessProjectEdit($role))
                    <div class="mb-4">
                        <a href="{{ route('project.edit', ['uuid' => $project->uuid]) }}" class="btn btn-success"><i
                                class="fa fa-plus"></i>Редактировать</a>
                    </div>
                @endif
            </div>
            <div class="card-footer text-muted">
                <p class="display-6">Участники</p>
                <ul class="list-group">
                    @foreach($members as $member)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $member->user->first_name }} {{ $member->user->last_name }}, {{ $member->user->email }}, {{ $member->user->phone }}
                            <span>
                                {{ $member->role }}
                            </span>
                            @if(\App\Helpers\Helper::accessProjectMember($role))
                                <a class="badge badge-pill badge-danger" href="{{ route('member.delete', ['id' => $member->id]) }}">Удалить</a>
                            @endif
                        </li>
                    @endforeach
                </ul>

                @if(\App\Helpers\Helper::accessProjectMember($role))
                    <p class="display-6">Добавить участников</p>
                    <form method="POST" action="{{ route('member.store') }}">
                        @csrf
                        <div class="form-row align-items-center d-flex">
                            <div class="form-group col-md-6">
                                <select class="form-control" name="user_id">
                                    @foreach($other_users as $other_user)
                                        <option value="{{ $other_user->id }}">{{ $other_user->first_name }} {{ $other_user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <select class="form-control" name="role">
                                    @foreach($roles as $key => $value)
                                        <option value="{{ $value }}">{{ \App\Helpers\Helper::getRoleText($value) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" value="{{ $project->id }}" name="project_id">
                        </div>
                        @if(count($other_users) > 0)
                            <button type="submit" class="btn btn-primary mb-2">Добавить</button>
                        @endif
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
{{-- Можно сделать удаление и добавление через js запросы по DELETE и POST --}}
