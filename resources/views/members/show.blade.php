@extends('layouts.app')

@section('content')
    <h1>Test</h1>

    <p>Organization :{{ $organization->id }}</p>

    <form action="{{ route('organizations.members.add') }}" method="post">
        <p>AJouter User</p>
        @csrf
        <select name="user_id" class="border rounded w-full p-2 mb-4 text-black">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->last_name }}</option>
            @endforeach
        </select>
        <input type="hidden" name="organization_id" value="{{ $organization->id }}">
        <input type="hidden" name="role" value="member" >
        <button type="submit">Submit</button>
    </form>

    <h3>Liste des Membres</h3>
    @foreach($usersMember as $member)
        <div class="flex flex-row gap-3">
        <p class="flex flex-row">{{ $member->user->first_name , "ID : pas la" }}</p>
        <p class="flex flex-row">{{ $member->user->last_name , "ID : pas la" }}</p>
        <p class="flex flex-row">{{ $member->role , "ID : pas la" }}</p>
        </div>
    @endforeach
@endsection
