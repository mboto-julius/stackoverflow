@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3>Editing answer for question : {{ $question->title }}</h3>
                        <a href="{{ route('questions.show', $question->slug) }}" class="btn btn-outline-danger">Back</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('answers.update', [$question->id, $answer->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <textarea class="form-control @error('body') is-invalid @enderror" rows="7"name="body">{{ $answer->body }}</textarea>
                            @error('body')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-lg btn-outline-primary">Update Your Answer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection