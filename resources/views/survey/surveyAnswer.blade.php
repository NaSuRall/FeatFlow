@extends('layouts.app')

@section('content')
        <h1>test</h1>


@foreach ($forms as $form)
    <div>
        <h2>{{ $form->question_text }}</h2>

        <form method="POST" action="{{ route('storeAnswer.store') }}">
            @csrf
            <input type="hidden" name="survey_id" value="{{ $form->id }}">

            @foreach ($form->questions as $question)
                <div>
                    <label>{{ $question->title }}</label>
                    <input type="hidden" name="survey_question_id" value="{{ $question->id }}">
                    @if ($question->question_type === "text")
                        <input type="text" name="answers[{{ $question->id }}]">
                    @else()
                        <p>Pas de questions disponible</p>
                    @endif
                </div>
            @endforeach
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">


            <button type="submit">Submit</button>
        </form>
    </div>
@endforeach



@endsection
