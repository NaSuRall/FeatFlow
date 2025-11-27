@extends('layouts.app')

@section('content')
    <h1>test</h1>


    @foreach ($surveys as $survey)
        <div>

            <form method="POST" action="{{ route('storeAnswer.store') }}">

                @csrf

                <input type="hidden" name="survey_id" value="{{ $survey->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                @foreach ($survey->questions as $question)
                    @php
                        $options = json_decode($question->options, true);
                    @endphp

                    <div>
                        <label><strong>{{ $question->title }}</strong></label>

                        <input type="hidden" name="survey_question_id[]" value="{{ $question->id }}">

                        @if ($question->question_type === "radio")
                            @foreach ($options as $key => $value)
                                <div>
                                    <input type="radio"
                                           name="answers[{{ $question->id }}]"
                                           id="radio_{{ $question->id }}_{{ $key }}"
                                           value="{{ $value }}">
                                    <label for="radio_{{ $question->id }}_{{ $key }}">
                                        {{ $value }}
                                    </label>
                                </div>
                            @endforeach

                        @elseif ($question->question_type === "checkbox")
                            @foreach ($options as $key => $value)
                                <div>
                                    <input type="checkbox"
                                           name="answers[{{ $question->id }}][]"
                                           id="checkbox_{{ $question->id }}_{{ $key }}"
                                           value="{{ $value }}">
                                    <label for="checkbox_{{ $question->id }}_{{ $key }}">
                                        {{ $value }}
                                    </label>
                                </div>
                            @endforeach
                        @endif


                    </div>
                @endforeach

                <button type="submit">Submit</button>
            </form>

        </div>
    @endforeach

@endsection
