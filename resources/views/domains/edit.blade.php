<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $domain->name }}
        </h2>
    </x-slot>
    <div class="container mx-auto">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                    <div class="flex justify-start">
                        <a href="{{ route('domains.index') }}" class="py-2 px-4 m-2 bg-green-500 hover:bg-green-300 text-gray-50 rounded-md">Back</a>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden sm:rounded-lg bg-gray-200 m-2 p-2">
                <div>
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Edit Domain</h3>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form action="{{ route('domain.update', $domain->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="nom">Nom du domaine de connaissance</label>
                                    <input
                                        type="text"
                                        name="nom"
                                        id="nom"
                                        value="{{ $domain->nom }}"
                                        class="form-control"
                                    >
                                </div>
                                <!-- Ajoutez les autres champs de formulaire pour l'édition du domaine de connaissance -->
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </form>
                        </div>
                        <div class="mt-4">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                        <div class="m-2 p-2">Sub Categories</div>
                                        <table class="w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Name
                                                    </th>
                                                    <th scope="col" class="relative px-6 py-3">
                                                        <span class="sr-only">Edit</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @forelse($domains->applications as $domains)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            {{ $domain->name }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <a href="{{ route('applications.edit', $domain->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                        <form method="POST" action="{{ route('applications.destroy', $domain->id) }}">
                                                            @csrf
                                                                @method('DELETE')
                                                            <a class="text-red-500 hover:text-red-900" href="{{ route('applications.destroy', $domain->id) }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                                Delete
                                                            </a>
                                                        </form>
                                                    </td>
                                                    @empty
                                                    <td>
                                                        <div class="m-2 p-2">No Sub Categories</div>
                                                    </td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
