@extends('layouts.app')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{ __("You're logged in!") }}

                    <div class="mt-6">
                        <h3 class="text-lg font-semibold mb-2">Créer une organisation</h3>

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
                                                <p>{{$organization->id}}</p>
                                            <div class="flex space-x-2">
                                                <form action="{{ route('organizations.update', $organization->id) }}" method="POST" class="flex items-center space-x-2 flex-1">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" name="name" value="{{ $organization->name }}" class="border rounded px-2 py-1 flex-1">
                                                    <button type="submit" class="bg-gray-300 px-3 py-1 rounded hover:bg-gray-400">
                                                        Modifier
                                                    </button>
                                                </form>

                                                <a href="/survey/{{ $organization->id }}" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400 openOrgBtn"
                                                        data-name="{{ $organization->name }}" data-id="{{ $organization->id }}">
                                                    Ouvrir
                                                </a>

                                                <button class="bg-gray-300 px-3 py-1 rounded hover:bg-gray-400 addMemberBtn"
                                                        data-name="{{ $organization->name }}" data-id="{{ $organization->id }}">
                                                    Ajouter membre
                                                </button>

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

    <!-- Modal ouvrir organization -->
    <div id="orgModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg p-6 w-96">
            <h3 class="text-lg font-semibold mb-4" id="orgModalTitle">Organisation</h3>
            <p id="orgModalContent">Contenu</p>

            <div class="mt-4 text-right">
                <button id="closeOrgModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Fermer
                </button>
            </div>
        </div>
    </div>

    <!-- Modal ajouter membre -->
    <div id="memberModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-gray-200 rounded-lg p-6 w-1/2 max-w-lg">
            <h3 class="text-xl font-bold mb-4" id="memberModalTitle">Ajouter</h3>

            <form id="addMemberForm" method="POST">
                @csrf
                <select name="user_id" class="border rounded w-full p-2 mb-4 text-black">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->first_name }}</option>
                    @endforeach
                </select>

                <div class="flex justify-end space-x-2">
                    <button type="submit" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Ajouter</button>
                    <button type="button" id="closeMemberModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Fermer</button>
                </div>
            </form>
        </div>
    </div>
@endsection
