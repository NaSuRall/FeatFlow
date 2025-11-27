@extends('layouts.app')

@section('content')
<div class="p-6 space-y-8 bg-gray-100 min-h-screen">
    <h1 class="text-3xl font-bold mb-8 text-center">{{ $survey->title }} — Rapport</h1>

    @foreach ($report as $index => $question)
        <div class="p-6 bg-white rounded-xl shadow-md border border-gray-200 max-w-4xl mx-auto">
            <h2 class="text-xl font-semibold mb-4">{{ $question->question }}</h2>

            @if(count($question->labels) > 0)
                @foreach($question->labels as $i => $label)
                    @php
                        $total = array_sum($question->data);
                        $count = $question->data[$i] ?? 0;
                        $percentage = $total > 0 ? round(($count / $total) * 100) : 0;
                    @endphp

                    <div class="mb-2">
                        <div class="flex justify-between mb-1 text-sm font-medium">
                            <span>{{ $label }}</span>
                            <span>{{ $percentage }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded h-4">
                            <div class="bg-blue-500 h-4 rounded" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-500 italic">Aucune réponse pour cette question.</p>
            @endif

            {{-- Infos supplémentaires --}}
            <div class="mt-4 flex flex-wrap text-sm text-gray-400 space-x-4">
                <span>Réponses totales : {{ array_sum($question->data) ?? 0 }}</span>
            </div>
        </div>
    @endforeach
</div>
@endsection
