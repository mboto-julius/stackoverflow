@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3>Questions</h3>
                        <a href="{{ route('questions.create') }}" class="btn btn-outline-secondary">Ask Question</a>
                    </div>
                </div>

                <div class="card-body">
                    @include('layouts.message')
                    @foreach ($questions as $question)
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
                                <h4 class="mt-0"><a href="{{ route('questions.show', $question->slug) }}" class="text-decoration-none">{{ $question->title }}</a></h4>
                                <p class="lead">Asked by 
                                    <a href="" class="text-decoration-none">{{ $question->user->name }}</a>
                                    <small class="text-muted">{{ $question->created_date }}</small>
                                </p>
                                <p>{!! Str::words($question->body, 100, '...') !!}</p>
                            </div>
                        </div>
                        <hr>
                    @endforeach

                    <div class="d-flex justify-content-center">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
