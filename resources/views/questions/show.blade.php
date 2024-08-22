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
                    <div class="d-flex flex-column">
                        <div>
                            <p>{!! $question->body !!}</p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="d-flex flex-column">
                                <span class="text-muted">Asked {{ $question->created_date }}</span>
                                <div class="d-flex align-items-center">
                                    <a href="">
                                        <i class="bi bi-person" style="font-size: 40px"></i>
                                    </a>
                                    <p class="pt-2">{{ $question->user->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>{{ $question->answers_count . " " . Str::plural('Answer', $question->answers_count) }}</h2>
                    </div>
                    <hr>
                    @foreach ($question->answers as $answer)
                        <div>
                            <p>{!! $answer->body !!}</p>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="d-flex flex-column">
                                <span class="text-muted">Answered {{ $answer->created_date }}</span>
                                <div class="d-flex align-items-center">
                                    <a href="">
                                        <i class="bi bi-person" style="font-size: 40px"></i>
                                    </a>
                                    <p class="pt-2">{{ $answer->user->name }}</p>
                                </div>
                            </div>
                        </div>
                        @if (!$loop->last)
                            <hr>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
