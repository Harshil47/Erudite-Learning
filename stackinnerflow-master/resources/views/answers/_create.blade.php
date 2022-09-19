<div class="row mt-4 justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Your Answer</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('questions.answers.store', $question->id) }}" method="POST">
                    @csrf
                    <div class="form-group">

                        <input type="hidden" id="body" name="body" value="{{ old('body') }}">
                        <trix-editor input="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}"></trix-editor>
                        @error('body')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
