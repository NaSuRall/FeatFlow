@extends('layouts.app')

@section('content')
    <div class="w-full mx-auto flex flex-col items-center justify-center  p-6">
        <h2 class="text-3xl flex">Repondre au Sondage</h2>
        @foreach ($surveys as $survey)
            <div class="bg-white w-1/2 shadow-md rounded-lg p-6 mb-8">
                <form method="POST" action="{{ route('storeAnswer.store') }}" class="space-y-6">
                    @csrf

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <input type="hidden" name="survey_id" value="{{ $survey->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                    @foreach ($survey->questions as $question)
                        @php
                            $options = json_decode($question->options, true);
                        @endphp

                        <div class="mb-6">
                            <label class="block text-lg font-semibold text-gray-800 mb-2">
                                {{ $question->title }}
                            </label>

                            <input type="hidden" name="survey_question_id[]" value="{{ $question->id }}">

                            @if ($question->question_type === "radio")
                                <div class="space-y-2">
                                    @foreach ($options as $key => $value)
                                        <label class="flex items-center space-x-2">
                                            <input type="radio"
                                                   name="answers[{{ $question->id }}]"
                                                   value="{{ $value }}"
                                                   class="text-blue-600 focus:ring-blue-500">
                                            <span class="text-gray-700">{{ $value }}</span>
                                        </label>
                                    @endforeach
                                </div>

                            @elseif ($question->question_type === "checkbox")
                                <div class="space-y-2">
                                    @foreach ($options as $key => $value)
                                        <label class="flex items-center space-x-2">
                                            <input type="checkbox"
                                                   name="answers[{{ $question->id }}][]"
                                                   value="{{ $value }}"
                                                   class="text-blue-600 focus:ring-blue-500">
                                            <span class="text-gray-700">{{ $value }}</span>
                                        </label>
                                    @endforeach
                                </div>

                            @elseif ($question->question_type === "text")
                                <div class="space-y-2">
                                    @foreach ($options as $key => $value)
                                        <input type="text"
                                               name="answers[{{ $question->id }}][]"
                                               value="{{ $value }}"
                                               class="w-full border-gray-300 rounded-md shadow-sm ">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach

                    <button type="submit"
                            class="w-full  text-black font-semibold py-2 px-4 rounded-md shadow">
                        Envoyer
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
