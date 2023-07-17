<x-app-layout>
    <x-slot name="header">
        {{ __( 'Edit service' ) }}
    </x-slot>

    <div class="rounded-lg bg-white p-4 shadow-md">

        <form action="{{ route('services.update', $service) }}" method="POST">
            @csrf
            @method('PATCH')

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input type="text"
                              id="name"
                              name="name"
                              class="block w-full"
                              value="{{ old('name', $service->name) }}"
                              required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-button>
                    {{ __('Submit') }}
                </x-button>
            </div>
        </form>

    </div>

</x-app-layout>