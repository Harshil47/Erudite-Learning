@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex mb-3 justify-content-end">
                <a href="{{ route('questions.create') }}" class="btn btn-primary">Ask a question!</a>
            </div>
            <div class="card">
                <div class="card-header">All Questions</div>
                @foreach ($questions as $question)
                    <div class="card-body">
                        <div class="media">
                            <div class="stats mr-3">
                                <div class="votes text-center mb-3">
                                    <strong class="d-block">{{ $question->votes_count }}</strong> Votes
                                </div>
                                <div class="answers {{ $question->answer_style }} text-center mb-3">
                                    <strong class="d-block">{{ $question->answers_count }}</strong> Answers
                                </div>
                                <div class="views text-center">
                                    <strong class="d-block">{{ $question->views_count }}</strong> Views
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="d-flex justify-content-between">
                                    <h4><a href="{{ $question->url }}">{{ $question->title }}</a></h4>
                                    <div>
                                        @can('update',$question)
                                            <a href="{{ route('questions.edit',$question->id) }}" class="btn btn-warning">Edit</a>
                                        @endcan

                                        @can('delete',$question)
                                            <form action="{{ route('questions.destroy',$question->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete it?')">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                                <p>{!! \Illuminate\Support\Str::limit($question->body, 250) !!}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach

                <div class="card-footer">
                    {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
