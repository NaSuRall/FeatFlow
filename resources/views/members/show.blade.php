@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full">
                <div class="p-6 text-gray-900 w-full">
                    <div class="mt-6 w-full">
                        <h3 class="text-lg font-semibold mb-2">
                            Organisation : {{ $organization->name }}
                        </h3>

                        <!-- Form pour ajouter un membre a l'organization -->
                        <div class="mt-6">
                            <form action="{{ route('organizations.members.add') }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block font-medium text-gray-700">Ajouter un membre</label>
                                    <select name="user_id" class="border rounded w-full p-2 mb-4 bg-white text-black">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="organization_id" value="{{ $organization->id }}">
                                    <input type="hidden" name="role" value="member">
                                </div>
                                <button type="submit" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                                    Ajouter
                                </button>
                            </form>
                        </div>

                        <!-- Affichage des différents membres de l'organization -->
                        <div class="mt-10">
                            <x-bladewind::accordion 
                                grouped="false" 
                                can_open_multiple="true" 
                                class="rounded-2xl"
                            >
                                <x-bladewind::accordion.item 
                                    title="Liste des membres"
                                    open="true"
                                    class="bg-white"
                                >
                                    @if($usersMember->isEmpty())
                                        <p class="text-gray-500">Aucun membre dans cette organisation.</p>
                                    @else
                                        @foreach($usersMember as $member)
                                            <div class="p-3 border rounded mb-3 flex items-center justify-between">
                                                <div class="space-y-1">
                                                    <p><span class="font-semibold">Prénom :</span> {{ $member->user->first_name }}</p>
                                                    <p><span class="font-semibold">Nom :</span> {{ $member->user->last_name }}</p>
                                                    <p><span class="font-semibold">Rôle :</span> {{ $member->role }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </x-bladewind::accordion.item>
                            </x-bladewind::accordion>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection