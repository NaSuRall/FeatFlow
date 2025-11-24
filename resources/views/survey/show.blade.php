<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $survey->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>{{ $survey->description }}</p>
                    <form>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
                            Envoyer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>