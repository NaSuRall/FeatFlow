<x-app-layout>
    <h1>test</h1>
    <form method="post" action="{{ route('survey.store') }}">
        @csrf
        <div>
            <input type="hidden" name="organization_id" value="1">
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

    <h2>Mettre a jour</h2>
    @foreach($surveys as $survey)
        <form method="post" action="{{route('survey.update', $survey)}}">
            @csrf
            @method('put')
            <input type="hidden" name="survey_id" value="{{ $survey->id }}">
            <input type="hidden" name="organization_id" value="1">
            <input type="text" placeholder="{{$survey->title}}" id="title" name="title" value="{{$survey->title}}">
            <input type="text" placeholder="{{$survey->description}}" id="description" name="description" value="{{$survey->description}}">
            <label for="start_date">Modifier la date de début</label>
            <input type="date" name="start_date" value="{{$survey->start_date}}">
            <label for="end_date">Modifier la date de fin</label>
            <input type="date" name="end_date" value="{{$survey->end_date}}">
            <label for="is-anonymous">Mettre le sondage en anonyme ?</label>
            <input type="checkbox" name="is_anonymous" value="1" {{ $survey->is_anonymous ? 'checked' : '' }}>

            <button type="submit" >Mettre a jour</button>
            <form method="post" action="{{route('survey.delete', $survey)}}">
                @csrf
                @method('put')
                <button type="submit">Supprimer</button>
            </form>
        </form>
    @endforeach
</x-app-layout>
