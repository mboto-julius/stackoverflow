<div class="row justify-content-center mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount . " " . Str::plural('Answer', $question->answers_count) }}</h2>
                </div>
                <hr>
                {{-- @include('layouts.message') --}}
                @foreach ($answers as $answer)
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
                                @can('accept', $answer)
                                    <a title="Mark this answer as best answer"
                                        class="{{ $answer->status }} d-flex flex-column gap-0 text-decoration-none"
                                        onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit();">
                                        <i class="bi bi-check-lg" style="font-size: 40px; cursor:pointer;"></i>
                                    </a>
                                    <form id="accept-answer-{{ $answer->id }}" action="{{ route('answers.accept', $answer->id) }}" method="POST" style="display:none;">
                                        @csrf
                                    </form>
                                @else
                                    @if($answer->is_best)
                                    <a title="The question owner accepted this answer as best answer"
                                        class="{{ $answer->status }} d-flex flex-column gap-0 text-decoration-none">
                                        <i class="bi bi-check-lg" style="font-size: 40px; cursor:pointer;"></i>
                                    </a> 
                                    @endif
                                @endcan
                            </div>
                        </div>
                        <div>
                            <div>
                                <p>{!! $answer->body !!}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="d-flex gap-2 pt-3">
                                    @can('update', $answer)
                                         <div>
                                            <a href="{{ route('answers.edit', [$question, $answer->id]) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                         </div>
                                    @endcan
                                    @can('delete', $answer)
                                        <form action="{{ route('answers.destroy', [$question, $answer->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    @endcan
                                </div>
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