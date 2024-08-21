@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @include('layouts.message')
                <div class="card-header">
                    <div>
                        <h3>{{ $question->title }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <p class="lead">Asked by 
                                <a href="" class="text-decoration-none">{{ $question->user->name }}</a>
                                <small class="text-muted">{{ $question->created_date }}</small>
                            </p>
                            <p>{!! $question->body !!}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div>
                        <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
