@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    {{-- Header --}}
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-8 text-center">
        {{ __('Dashboard') }}
    </h2>

    {{-- Grid des actions --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
        {{-- Organisations --}}
        <a href="{{ route('organization.index') }}" class="bg-white shadow rounded-lg p-6 flex flex-col items-center justify-center hover:shadow-lg transition">
            <div class="text-blue-500 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/>
                </svg>
            </div>
            <span class="text-lg font-semibold">Organisations</span>
        </a>
    </div>
</div>
@endsection
