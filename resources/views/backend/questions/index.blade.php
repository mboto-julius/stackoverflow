@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Questions</h4>
                </div>

                <div class="card-body">
                    @foreach ($questions as $question)
                        <div class="media">
                            <div class="media-body">
                                <h4 class="mt-0"><a href="{{ route('questions.show', $question->slug) }}" class="text-decoration-none">{{ $question->title }}</a></h4>
                                <p class="lead">Asked by 
                                    <a href="" class="text-decoration-none">{{ $question->user->name }}</a>
                                    <small class="text-muted">{{ $question->created_date }}</small>
                                </p>
                                <p>{!! Str::words($question->body, 80, '...') !!}</p>
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
