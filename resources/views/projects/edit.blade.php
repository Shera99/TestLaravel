@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="jumbotron-fluid rounded bg-white border-0 shadow-sm border-left"
                 style="padding-left: 15px; margin-bottom: 10px;">
                <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                    <form method="POST" action="{{ route('project.update', ['project' => $project->id]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="title">Название проекта</label>
                            <input class="form-control" type="text" placeholder="Default input" id="title" name="name"
                                   value="{{ $project->name }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Example textarea</label>
                            <textarea class="form-control" id="description" rows="3"
                                      name="description">{{ $project->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Статус</label>
                            <select class="form-control" id="status" name="status">
                                @foreach($statuses as $key => $value)
                                    <option value="{{ $value }}" @if($project->status == $value) selected @endif>{{ \App\Helpers\Helper::getProjectStatusText($value)['text'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
