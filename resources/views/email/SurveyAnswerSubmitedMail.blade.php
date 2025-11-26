<h1>Nouvelle réponse soumise</h1>
<p>Une nouvelle réponse a été soumise pour le sondage : {{ $surveyAnswer->survey->title }}</p>
<p>Répondant : {{ $surveyAnswer->user->name }} ({{ $surveyAnswer->user->email }})</p>
<p>Réponse :</p>
<ul>
    @foreach($surveyAnswer->answers as $question => $answer)
        <li><strong>{{ $question }}:</strong> {{ $answer }}</li>
    @endforeach     
</ul>