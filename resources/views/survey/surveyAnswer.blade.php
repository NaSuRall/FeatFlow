@extends('layouts.app')

@section('content')
    <h1>test</h1>

    @foreach ($forms as $form)
        <div>
            <h2>{{ $form->question_text }}</h2>

            <form method="POST" action="{{ route('storeAnswer.store') }}">
                @csrf

                <input type="hidden" name="survey_id" value="{{ $form->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                @foreach ($form->questions as $question)
                    @php
                        $options = json_decode($question->options, true);
                    @endphp

                    <div style="margin-bottom: 15px;">
                        <label><strong>{{ $question->title }}</strong></label>

                        <input type="hidden" name="survey_question_id[]" value="{{ $question->id }}">

                        @if ($question->question_type === "radio")
                            @if (!empty($options))
                                @foreach ($options as $key => $value)
                                    <div>
                                        <input type="radio"
                                               name="reponse_{{ $question->id }}"
                                               id="radio_{{ $question->id }}_{{ $key }}"
                                               value="{{ $value }}">
                                        <label for="radio_{{ $question->id }}_{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                <p style="color:red;">⚠ Aucune option disponible</p>
                            @endif

                        @elseif ($question->question_type === "checkbox")
                            @if (!empty($options))
                                @foreach ($options as $key => $value)
                                    <div>
                                        <input type="checkbox"
                                               name="reponse_{{ $question->id }}[]"
                                               id="checkbox_{{ $question->id }}_{{ $key }}"
                                               value="{{ $value }}">
                                        <label for="checkbox_{{ $question->id }}_{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                <p style="color:red;">⚠ Aucune option disponible</p>
                            @endif

                        @else
                            <p>Pas de questions disponible</p>
                        @endif

                    </div>
                @endforeach

                <button type="submit">Submit</button>
            </form>

        </div>
    @endforeach

@endsection
