@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @include('layouts.message')
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3>{{ $question->title }}</h3>
                        <a href="{{ route('questions.index') }}" class="btn btn-outline-danger">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="vote-controls mx-3 d-flex flex-column align-items-center">
                            <a title="This question is useful" 
                                href="" 
                                class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                                onclick="event.preventDefault(); document.getElementById('up-vote-question-{{ $question->id }}').submit();"
                                >
                                <i class="bi bi-caret-up-fill" style="font-size: 34px; color:#545454;"></i>
                            </a>
                            <form id="up-vote-question-{{ $question->id }}" action="/questions/{{ $question->id }}/vote" method="POST" style="display:none;">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>
                            <span class="votes-count fs-4">{{ $question->votes_count }}</span>
                            <a title="This question is not useful" 
                                style="cursor: pointer"
                                class="vote-down {{ Auth::guest() ? 'off' : '' }}"
                                onclick="event.preventDefault(); document.getElementById('down-vote-question-{{ $question->id }}').submit();"
                                >
                                <i class="bi bi-caret-down-fill" style="font-size: 34px; color:#909090;"></i>
                            </a>
                            <form id="down-vote-question-{{ $question->id }}" action="/questions/{{ $question->id }}/vote" method="POST" style="display:none;">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>
                            <a style="cursor: pointer" title="Click to mark as favorite question (click again to undo)"
                                class="d-flex flex-column gap-0 text-decoration-none {{ Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited': '') }}"
                                onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit();">
                                <i class="bi bi-star-fill" style="font-size: 30px;"></i>
                                <span class="favourites-count d-flex justify-content-center">{{ $question->favorites_count }}</span>
                            </a>
                            <form id="favorite-question-{{ $question->id }}" action="/questions/{{ $question->id }}/favorites" method="POST" style="display:none;">
                                @csrf
                                @if($question->is_favorited)
                                    @method('DELETE')
                                @endif
                            </form>
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
    @include('answers.index',[
        'answers' => $question->latestAnswers,
        'answersCount' => $question->answers_count
    ])
    @include('answers.create')
</div>
@endsection
