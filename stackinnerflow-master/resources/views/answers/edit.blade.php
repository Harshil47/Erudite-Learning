@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mt-4 justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Edit your Answer</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('questions.answers.update', [$question->id,$answer->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">

                            <input type="hidden" id="body" name="body" value="{{ old('body',$answer->body) }}">
                            <trix-editor input="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}"></trix-editor>
                            @error('body')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('page-level-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('page-level-styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
