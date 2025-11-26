@extends('layouts.app')
@section('content')
    <form action="{{ route('question.store') }}" method="POST">
        @csrf

        <input name="survey_id" type="hidden" value={{ $survey_id }}>
        <input type="text" name="title">
        <div class="mb-3">
            <label for="question_type" class="form-label">Type de question</label>
            <select name="question_type" id="question_type" class="form-select" required>
                <option value="">-- Sélectionnez --</option>
                <option value="radio">Choix unique (radio)</option>
                <option value="checkbox">Choix multiple (checkbox)</option>
                <option value="text">Texte libre</option>
            </select>
        </div>

        <div id="answers-form" style="display:none;">
            <h4>Définir les réponses possibles</h4>

            <!-- Radio -->
            <div id="radio-options" style="display:none;">
                <div class="mb-3">
                    <label>Option 1</label>
                    <input type="text" name="options[]" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Option 2</label>
                    <input type="text" name="options[]" class="form-control">
                </div>
            </div>

            <div id="checkbox-options" style="display:none;">
                <div class="mb-3">
                    <label>Option 1</label>
                    <input type="text" name="options[]" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Option 2</label>
                    <input type="text" name="options[]" class="form-control">
                </div>
            </div>

            <div id="text-option" style="display:none;">
                <p>Pas besoin de définir des réponses, l’utilisateur saisira son texte libre.</p>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
    </form>
@endsection
