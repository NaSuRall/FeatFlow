<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

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
                                    class="px-4 py-2 bg-blue-600 rounded hover:bg-blue-700"
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
                                        <div class="p-3 border rounded mb-3 flex items-center justify-between">

                                            <!-- Champ texte à gauche -->
                                            <form action="{{ route('organizations.update', $organization->id) }}" method="POST" class="flex items-center space-x-2 flex-1">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="name" value="{{ $organization->name }}" class="border rounded px-2 py-1 flex-1">
                                                <button type="submit" class="bg-green-500 px-3 py-1 rounded hover:bg-green-600">
                                                    Modifier
                                                </button>
                                            </form>

                                            <div class="flex space-x-2">
                                                <button class="bg-blue-500 px-3 py-1 rounded hover:bg-blue-600 openOrgBtn" 
                                                    data-name="{{ $organization->name }}" data-id="{{ $organization->id }}">
                                                    Ouvrir
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
    
    <!-- Modal Organisation -->
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

</x-app-layout>


<script>
    const modal = document.getElementById('orgModal');
    const modalTitle = document.getElementById('orgModalTitle');
    const modalContent = document.getElementById('orgModalContent');
    const closeBtn = document.getElementById('closeOrgModal');

    document.querySelectorAll('.openOrgBtn').forEach(btn => {
        btn.addEventListener('click', () => {
            const name = btn.dataset.name;
            modalTitle.innerText = name;
            modalContent.innerText = "Mettre les sondages ici";
            modal.classList.remove('hidden');
        });
    });

    closeBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });
</script>
