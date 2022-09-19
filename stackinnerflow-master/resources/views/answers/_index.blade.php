<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="mt-0">{{ \Illuminate\Support\Str::plural('Answer', $question->answers_count) }}</h3>
            </div>
            <div class="card-body">
                @foreach ($question->answers as $answer)
                    {!! $answer->body !!}
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <div>
                                @auth
                                    <form action="{{ route('answers.votes', [$answer->id, 1]) }}" method="POST">
                                        @csrf
                                        <button title="Up-vote" type="submit" class="btn {{ auth()->user()->hasAnswerUpVote($answer) ? 'text-success' : 'text-black-50' }}">
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
                                <h4 class="m-0 text-muted text-center vote-count">{{ $answer->votes_count }}</h4>
                                @auth
                                    <form action="{{ route('answers.votes', [$answer->id, -1]) }}" method="POST">
                                        @csrf
                                        <button title="Down-vote" type="submit" class="btn {{ auth()->user()->hasAnswerDownVote($answer) ? 'text-danger' : 'text-black-50' }}">
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
                                @can('markAsBest', $answer)
                                    <form action="{{ route('answers.bestAnswer', $answer->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button title="Mark as Correct" type="submit" class="btn {{ $answer->best_answer_style }}">
                                            <i class="fa fa-check fa-2x"></i>
                                        </button>
                                    </form>

                                @else
                                    @if ($answer->is_best_answer)
                                        <i class="fa fa-check fa-2x text-success d-block mb-2"></i>
                                    @endif
                                @endcan


                                <h4 class="m-0 text-muted text-center views-count">145</h4>
                            </div>
                        </div>
                        <div class="justify-content-between text-center">
                            @can('update',$answer)
                                <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-warning ml-5">Edit</a>
                            @endcan
                            @can('delete',$answer)
                                <form class="d-inline" action="{{ route('questions.answers.destroy' ,[$question->id, $answer->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger ml-3"
                                            type="submit"
                                            onclick="return confirm('Are you sure, You want to delete this answer?')"
                                    >Delete</button>
                                </form>
                            @endcan
                        </div>
                        <div class="d-flex flex-column">
                            <div class="text-muted mb-2 text-right mt-2">
                                <p>Answered {{ $answer->created_date }}</p>
                            </div>
                            <div class="d-flex mb-2">
                                <div>
                                    <img src="{{ $answer->author->avatar }}" alt="">
                                </div>
                                <div class="mt-2 ml-2">
                                    <p>{{ $answer->author->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
