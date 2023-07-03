<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Domains') }}
        </h2>
    </x-slot>
    <div class="container mx-auto">
        @if (session('message'))
        <div class="bg-indigo-600 text-gray-100 m-2 p-2 text-lg text-center">{{ session('message') }}</div>
        @endif
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">

                    <div class="mb-4 flex justify-between">
                        <a class="btn btn-success"
                        {{-- class="rounded-lg border border-transparent bg-purple-600 px-4 py-2 text-center text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-600"  --}}
                        href="{{ route('domain.create') }}">
                            {{ __('Create') }}
                         </a>
                    </div>
            </div>
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <h1>Liste des domaines de connaissance</h1>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <!-- Ajoutez d'autres en-têtes de colonnes si nécessaire -->
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($domains as $domain)
                                <tr>
                                    <td>{{ $domain->id }}</td>
                                    <td>{{ $domain->name }}</td>
                                    <!-- Ajoutez d'autres colonnes de données si nécessaire -->
                                    <td>
                                        <a href="{{ route('domain.show', $domain->id) }}">Afficher</a>
                                        <a href="{{ route('domain.edit', $domain->id) }}">Modifier</a>
                                        <form action="{{ route('domain.destroy', $domain->id) }}" method="POST">
                                            @csrf
                    @method('DELETE')
                                            <button type="submit">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody

                        {{-- <div class="p-2 m-2">
                            {{ $domains->links() }}
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
