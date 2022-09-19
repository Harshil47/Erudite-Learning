@extends('layouts.app')
@section('page-level-styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1>{{ $question->title }}</h1></div>
                <div class="card-body">
                    {!! $question->body !!}
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <div>
                                @auth
                                    <form action="{{ route('questions.votes', [$question->id, 1]) }}" method="POST">
                                        @csrf
                                        <button title="Up-vote" type="submit" class="btn {{ auth()->user()->hasQuestionUpVote($question) ? 'text-success' : 'text-black-50' }}">
                                            <i class="fa fa-caret-up fa-3x"></i>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="vote-up d-block text-center text-black-50" title="Up-Vote">
                                        <i class="fa fa-caret-up fa-3x"></i>
                                    </a>
                                @endauth
                                <a href="" class="vote-up d-block text-center text-black-50" title="Up-Vote">

                                </a>
                                <h4 class="m-0 text-muted text-center vote-count">{{ $question->votes_count }}</h4>
                                @auth
                                    <form action="{{ route('questions.votes', [$question->id, -1]) }}" method="POST">
                                        @csrf
                                        <button title="Down-vote" type="submit" class="btn {{ auth()->user()->hasQuestionDownVote($question) ? 'text-danger' : 'text-black-50' }}">
                                            <i class="fa fa-caret-down fa-3x"></i>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="vote-up d-block text-center text-black-50" title="Down-Vote">
                                        <i class="fa fa-caret-down fa-3x"></i>
                                    </a>
                                @endauth
                            </div>
                            <div class="ml-5 mt-3">
                                @can('markAsFavorite',$question)
                                    <form action="{{ route($question->is_favorite ? 'questions.unfavorite' : 'questions.favorite',$question->id) }}" method="POST">
                                    @csrf
                                    @if ($question->is_favorite)
                                        @method('DELETE')
                                    @endif
                                    <button type="submit" class="btn {{ $question->favorite_style }}">
                                        <i class="fa fa-star fa-2x"></i>
                                    </button>
                                    </form>
                                @else
                                    <i class="fa fa-star-o text-success d-block fa-2x"></i>
                                @endcan

                                </a>
                                <h4 class="m-0 {{ $question->favorite_style }} text-center views-count">{{ $question->favorites_count }}</h4>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <div class="text-muted mb-2 text-right">
                                <p>Asked {{ $question->created_date }}</p>
                            </div>
                            <div class="d-flex mb-2">
                                <div>
                                    <img src="{{ $question->owner->avatar }}" alt="">
                                </div>
                                <div class="mt-2 ml-2">
                                    <p>{{ $question->owner->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('answers._index')
    @include('answers._create')
</div>
@endsection
@section('page-level-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection


