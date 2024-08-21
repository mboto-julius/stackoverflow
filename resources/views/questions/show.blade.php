@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @include('layouts.message')
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3>{{ $question->title }}</h3>
                        <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back</a>
                    </div>
                </div>

                <div class="card-body">
                        <div class="d-flex">
                            <div class="d-flex flex-column counters">
                                <div class="vote">
                                    <strong>{{ $question->votes }}</strong> {{ Str::plural('vote', $question->votes) }}
                                </div>
                                <div class="status {{ $question->status }} my-2">
                                    <strong>{{ $question->answers }}</strong> {{ Str::plural('answer', $question->answers) }}
                                </div>
                                <div class="view">
                                    {{ $question->views . " " . Str::plural('view', $question->views) }}
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-center">
                                    <h4 class="mt-0"><a href="{{ route('questions.show', $question->slug) }}" class="text-decoration-none">{{ $question->title }}</a></h4>
                                    <div class="ms-auto">
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                            <form action="{{ route('questions.destroy', $question->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <p class="lead">Asked by 
                                    <a href="" class="text-decoration-none">{{ $question->user->name }}</a>
                                    <small class="text-muted">{{ $question->created_date }}</small>
                                </p>
                                <p>{!! $question->body !!}</p>
                            </div>
                        </div>
                        <hr>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
