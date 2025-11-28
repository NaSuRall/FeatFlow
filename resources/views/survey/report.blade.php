@extends('layouts.app')

@section('content')
<div class="p-6 bg-gray-100">
    <h1 class="text-2xl font-bold mb-8 text-center">{{ $survey->title }} — Rapport</h1>

    <div class="max-w-4xl mx-auto mt-8">
        <h2 class="text-xl font-semibold mt-10 mb-4">Participants</h2>

        <ul class="bg-white p-4 rounded shadow">
            @foreach($participants as $p)
                <li class="border-b py-2">{{ $p }}</li>
            @endforeach
        </ul>
        <x-bladewind::accordion 
            grouped="true" 
            can_open_multiple="true" 
            class="rounded-2xl"
        >
            @foreach($report as $index => $question)
                <x-bladewind::accordion.item 
                    title="{{ $question->question }} ({{ $total = array_sum($question->data) }} {{ $total === 1 ? 'réponse' : 'réponses' }})"
                    open="false"
                    class="bg-white"
                >
                    @if(count($question->labels) > 0)
                        <div style="height: 200px; width: 200px; margin:auto;">
                            <canvas id="chart{{ $index }}"></canvas>
                        </div>
                    @else
                        <p class="text-gray-500 italic">Aucune réponse pour cette question.</p>
                    @endif
                </x-bladewind::accordion.item>
            @endforeach
        </x-bladewind::accordion>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function generateColors(n) {
        const colors = [];
        for (let i = 0; i < n; i++) {
            const hue = (i * 137.508) % 360; // golden angle for distinct colors
            colors.push(`hsl(${hue}, 65%, 60%)`);
        }
        return colors;
    }

    @foreach($report as $index => $question)
        @if(count($question->labels) > 0)
            const ctx{{ $index }} = document.getElementById('chart{{ $index }}');
            ctx{{ $index }}.addEventListener('click', function(e){
                e.stopPropagation();
            });

            new Chart(ctx{{ $index }}, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($question->labels) !!},
                    datasets: [{
                        data: {!! json_encode($question->data) !!},
                        backgroundColor: generateColors({{ count($question->labels) }}),
                        borderColor: '#fff',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                padding: 10
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const count = context.raw;
                                    const word = count === 1 ? 'réponse' : 'réponses';
                                    return context.label + ': ' + count + ' ' + word;
                                }
                            }
                        }
                    }
                }
            });
        @endif
    @endforeach
</script>
@endsection
