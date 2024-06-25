@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <div class="d-flex justify-content-between mb-3">
                    <h1>{{ $project->name }}</h1>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Back to Projects</a>
                </div>
                <div class="card">
                    <div class="card-header">{{ __('Project Details') }}</div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $project->name }}</p>
                        <p><strong>Description:</strong> {{ $project->description }}</p>
                        <p><strong>Slug:</strong> {{ $project->slug }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
