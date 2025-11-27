@extends('layouts.app')

@section('content')

    @if(session('success'))
        <!-- show if a survey is create -->
        <div style="color: green; padding: 10px; margin: 10px 0; border: 1px solid green;">
            {{ session('success') }}
        </div>
    @endif

    <h1>Créer un nouveau sondage</h1>
    <form method="post" action="{{ route('survey.store') }}">
        @csrf
        <div>
            <!-- retrieve the organization id saved in the user session -->
            <input type="hidden" name="organization_id" value="{{ session('organization_id')  }}">
            <input type="text" placeholder="Entrer le titre du sondage" id="title" name="title">
            <input type="text" placeholder="Entrer la description" id="description" name="description">
            <label for="start_date">Entrez la date de début</label>
            <input type="date" name="start_date">
            <label for="end_date">Entrez la date de fin</label>
            <input type="date" name="end_date">
            <label for="is-anonymous">Mettre le sondage en anonyme ?</label>
            <input type="hidden" name="is_anonymous" value="0">
            <input type="checkbox" name="is_anonymous" value="1">
        </div>
        <button type="submit">Créer</button>
    </form>

    <h2>Mes sondages</h2>
    @foreach($surveys as $survey)
        <div>
            <h3>Nom du sondage:{{ $survey->title }}</h3>

            <!-- survey' public link -->
            @if($survey->token)
                <p>Lien public :
                    <a href="{{ url('/survey/answer/'.$survey->token) }}" target="_blank">
                        {{ url('/survey/answer/'.$survey->token) }}
                    </a>
                    <button onclick="navigator.clipboard.writeText('{{ url('/survey/answer/'.$survey->token) }}')">
                        Copier le lien
                    </button>
                </p>
            @endif

            <form method="post" action="{{ route('survey.update', $survey) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="survey_id" value="{{ $survey->id }}">
                <input type="text" placeholder="{{$survey->title}}" id="title_{{$survey->id}}" name="title" value="{{$survey->title}}">
                <input type="text" placeholder="{{$survey->description}}" id="description_{{$survey->id}}" name="description" value="{{$survey->description}}">
                <label for="start_date_{{$survey->id}}">Modifier la date de début</label>
                <input type="date" id="start_date_{{$survey->id}}" name="start_date" value="{{$survey->start_date}}">
                <label for="end_date_{{$survey->id}}">Modifier la date de fin</label>
                <input type="date" id="end_date_{{$survey->id}}" name="end_date" value="{{$survey->end_date}}">
                <label for="is_anonymous_{{$survey->id}}">Mettre le sondage en anonyme ?</label>
                <input type="checkbox" id="is_anonymous_{{$survey->id}}" name="is_anonymous" value="1" {{ $survey->is_anonymous ? 'checked' : '' }}>
                <button type="submit">Mettre à jour</button>
            </form>

            <form method="post" action="{{route('survey.delete', $survey)}}" style="display: inline;"
                  onsubmit="return confirm('Êtes vous sûr de vouloir supprimer ce sondage ?');">
                @csrf
                @method('DELETE')
                <button type="submit">
                    Supprimer
                </button>
            </form>

            <a href="/question/{{$survey->id}}">Ajouter des questions</a>
        </div>
    @endforeach

@endsection
