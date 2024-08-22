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
                        <div class="vote-controls mx-3 d-flex flex-column align-items-center">
                            <a title="This question is useful" href="" class="vote-up">
                                <i class="bi bi-caret-up-fill" style="font-size: 34px; color:#545454;"></i>
                            </a>
                            <span class="votes-count fs-4">1500</span>
                            <a title="This question is not useful" href="" class="vote-down off">
                                <i class="bi bi-caret-down-fill" style="font-size: 34px; color:#909090;"></i>
                            </a>
                            <a href="" class="d-flex flex-column gap-0 text-decoration-none">
                                <i title="Click to mark as favorite question (click again to undo)" class="bi bi-star-fill" style="font-size: 30px; color:#545454;"></i>
                                <span class="favourites-count" style="color:#545454;">129</span>
                            </a>
                        </div>
                        <div class="d-flex flex-column">
                            <div>
                                <p>{!! $question->body !!}</p>
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="d-flex flex-column">
                                    <span class="text-muted">Asked {{ $question->created_date }}</span>
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="">
                                            <i class="bi bi-person-circle" style="font-size: 40px"></i>
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
                        <div class="d-flex">
                            <div>
                                <div class="vote-controls mx-3 d-flex flex-column align-items-center">
                                    <a title="This answer is useful" href="" class="vote-up">
                                        <i class="bi bi-caret-up-fill" style="font-size: 34px; color:#545454;"></i>
                                    </a>
                                    <span class="votes-count fs-4">1500</span>
                                    <a title="This answer is not useful" href="" class="vote-down off">
                                        <i class="bi bi-caret-down-fill" style="font-size: 34px; color:#909090;"></i>
                                    </a>
                                    <a href="" class="d-flex flex-column gap-0 text-decoration-none">
                                        <i title="Mark this answer as best answer" class="bi bi-check-lg" style="font-size: 40px; color:#11BA57;"></i>
                                    </a>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <p>{!! $answer->body !!}</p>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="d-flex flex-column">
                                        <span class="text-muted">Answered {{ $answer->created_date }}</span>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="">
                                                <i class="bi bi-person-circle" style="font-size: 40px"></i>
                                            </a>
                                            <p class="pt-2">{{ $answer->user->name }}</p>
                                        </div>
                                    </div>
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
