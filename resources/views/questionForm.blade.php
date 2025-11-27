@extends('layouts.app')
@section('content')

    <div class="flex flex-col w-1/2 min-h-screen items-center justify-center bg-gray-900 ">
            <h1 class="text-3xl text-black">Ajouter une Question</h1>

        <form action="{{ route('question.store') }}" method="POST"
              class="flex flex-col p-6 border-2 border-black rounded-xl mt-3">
            @csrf
            <input name="survey_id" type="hidden" value={{ $survey_id }}>
            <input type="text" name="title" placeholder="Titre de la question" class="form-control mb-3">

            <div class="mb-3">
                <label for="question_type" class="form-label">Type de question</label>
                <select name="question_type" id="question_type" class="form-select" required>
                    <option value="">-- Sélectionnez --</option>
                    <option value="radio">Choix unique (radio)</option>
                    <option value="checkbox">Choix multiple (checkbox)</option>
                    <option value="text">Texte libre</option>
                </select>
            </div>

            <!-- pour les options -->
            <div id="options-container" class="flex flex-col gap-3 mb-2">
                <input type="text" name="options[]" class="form-control mb-2" placeholder="Option 1">
            </div>

            <!-- pour ajouter une option -->
            <button type="button" id="add-option" class="px-6 py-2 text-black border-2 rounded-xl">Ajouter une option</button>

            <button type="submit" class="btn btn-primary mt-3 border-2 rounded-xl">Enregistrer</button>
        </form>

    </div>

@endsection
