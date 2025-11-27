@extends('layouts.app')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold mb-2">Créer une organisation</h3>

                        <!-- Form pour créer une organization en entrant le nom -->
                        <form action="{{ route('organizations.store') }}" method="POST" class="space-y-4">
                            @csrf

                            <div>
                                <label for="name" class="block font-medium text-gray-700">
                                    Nom de l'organisation
                                </label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                >
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <button
                                    type="submit"
                                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400"
                                >
                                    Créer
                                </button>
                            </div>
                        </form>

                        <!-- Permet d'afficher toutes les organizations du user connecté -->
                        <div class="mt-10">
                            <h3 class="text-lg font-semibold mb-3">Liste des organisations</h3>
                            @isset($organizations)
                                @if($organizations->isEmpty())
                                    <p class="text-gray-500">Aucune organisation trouvée.</p>
                                @else
                                    @foreach ($organizations as $organization)
                                        @php
                                            session()->put($organization->id)
                                        @endphp
                                        <div class="p-3 border rounded mb-3 flex items-center justify-between">
                                            <div class="flex space-x-2">

                                                <!-- Bouton modifier dans organization pour modifier nom de l'organization -->
                                                <form action="{{ route('organizations.update', $organization->id) }}" method="POST" class="flex items-center space-x-2 flex-1">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" name="name" value="{{ $organization->name }}" class="border rounded px-2 py-1 flex-1">
                                                    <button type="submit" class="bg-gray-300 px-3 py-1 rounded hover:bg-gray-400">
                                                        Modifier
                                                    </button>
                                                </form>

                                                <!-- Bouton ouvrir dans organization pour créer un sondage -->
                                                <a href="/survey/{{ $organization->id }}" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400 openOrgBtn">
                                                    Ouvrir
                                                </a>

                                                <!-- Bouton membre dans organization pour afficher les membres du sondage et en ajouter -->
                                                <a href="{{ route('organizations.members.show', $organization->id ) }}" class="bg-gray-300 px-3 py-1 rounded hover:bg-gray-400 addMemberBtn">
                                                    Membre
                                                </a>

                                                <!-- Bouton supprimer dans organization pour supprimer l'organization -->
                                                <form action="{{ route('organizations.destroy', $organization->id) }}" method="POST"
                                                      onsubmit="return confirm('Voulez-vous vraiment supprimer cette organisation ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
