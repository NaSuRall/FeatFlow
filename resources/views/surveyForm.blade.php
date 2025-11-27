@extends('layouts.app')

@section('content')

    <div class="max-w-3xl mx-auto mt-10">

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-6 border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-6 border border-red-300">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="text-2xl font-bold mb-4">Créer un nouveau sondage</h1>

        <form method="post" action="{{ route('survey.store') }}" class="bg-white shadow p-6 rounded-lg space-y-4">
            @csrf

            <input type="hidden" name="organization_id" value="{{ session('organization_id') }}">
            <input type="text" class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="Titre du sondage" name="title">
            <input type="text" class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="Description" name="description">
            <div>
                <label class="font-medium">Date de début</label>
                <input type="date" name="start_date" class="w-full border-gray-300 rounded-lg shadow-sm mt-1">
            </div>
            <div>
                <label class="font-medium">Date de fin</label>
                <input type="date" name="end_date" class="w-full border-gray-300 rounded-lg shadow-sm mt-1">
            </div>
            <div class="flex items-center space-x-2">
                <input type="hidden" name="is_anonymous" value="0">
                <input type="checkbox" name="is_anonymous" value="1" class="h-4 w-4">
                <label>Mettre le sondage en anonyme ?</label>
            </div>
            <button type="submit">Créer</button>
        </form>

        <h2 class="text-xl font-bold mt-10 mb-4">Mes sondages</h2>

        @foreach($surveys as $survey)
            <div class="bg-white shadow p-6 rounded-lg mb-6">
                <h3 class="text-lg font-semibold mb-2">Nom du sondage : {{ $survey->title }}</h3>
                @if($survey->token)
                    <p class="mb-3">
                        <span class="font-medium">Lien public :</span>
                        <a href="{{ url('/survey/answer/'.$survey->token) }}" target="_blank" class="text-blue-600 underline">{{ url('/survey/answer/'.$survey->token) }}</a>

                        <button onclick="navigator.clipboard.writeText('{{ url('/survey/answer/'.$survey->token) }}')" class="ml-2 px-2 py-1 text-sm bg-gray-200 rounded hover:bg-gray-300">Copier</button>
                    </p>
                @endif
                <form method="post" action="{{ route('survey.update', $survey) }}" class="space-y-3">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="survey_id" value="{{ $survey->id }}">
                    <input type="text" name="title" value="{{ $survey->title }}" class="w-full border-gray-300 rounded-lg shadow-sm">

                    <input type="text" name="description" value="{{ $survey->description }}" class="w-full border-gray-300 rounded-lg shadow-sm">
                    <div>
                        <label class="font-medium">Modifier la date de début</label>
                        <input type="date" name="start_date" value="{{ $survey->start_date }}" class="w-full border-gray-300 rounded-lg shadow-sm mt-1">
                    </div>
                    <div>
                        <label class="font-medium">Modifier la date de fin</label>
                        <input type="date" name="end_date" value="{{ $survey->end_date }}" class="w-full border-gray-300 rounded-lg shadow-sm mt-1">
                    </div>
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="is_anonymous" value="1" class="h-4 w-4"
                            {{ $survey->is_anonymous ? 'checked' : '' }}>
                        <label>Mettre le sondage en anonyme ?</label>
                    </div>

                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition">
                        Mettre à jour
                    </button>
                </form>
                <form method="post" action="{{ route('survey.delete', $survey) }}" class="inline-block mt-4" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce sondage ?');">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">Supprimer</button>

                </form>
                <a href="/question/{{ $survey->id }}" class="ml-3 inline-block text-blue-600 underline">Ajouter des questions</a>
            </div>
        @endforeach
    </div>
@endsection
