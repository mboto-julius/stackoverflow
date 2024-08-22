<div class="row my-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Your Answer</h3>
                </div>
                <form action="{{ route('answers.store', $question->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <textarea class="form-control @error('body') is-invalid @enderror" rows="7"name="body">{{ old('body') }}</textarea>
                        @error('body')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-lg btn-outline-primary">Post Your Answer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>