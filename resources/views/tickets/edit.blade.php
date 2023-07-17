<x-app-layout>
    <x-slot name="header">
        {{ __('Edit ticket') }}
    </x-slot>

    <div class="rounded-lg bg-white p-4 shadow-md">

        <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mt-4">
                <x-input-label for="status_id" :value="__('Status')" />
                <select name="status_id" id="status_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus-within:text-primary-600 focus:border-primary-300 focus:ring-primary-200 focus:ring focus:ring-opacity-50">
                    @foreach($status as $id => $name)
                        <option value="{{ $id }}" @selected( {{ (isset($ticket) && $ticket->status ? $ticket->id : old('status_id')) == $id ? 'selected' : '' }})>{{ $name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('status')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="title" :value="__('Title')" />
                <input type="text" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus-within:text-primary-600 focus:border-primary-300 focus:ring-primary-200 focus:ring focus:ring-opacity-50"
                name="title" 
                value="{{ $ticket->title }}" 
                disabled>
            </div>

            <div class="mt-4">
                <x-input-label for="message" :value="__('Message')" />
                <input type="text" 
                class="mt-1 block h-32 w-full rounded-md border-gray-300 shadow-sm focus-within:text-primary-600 focus:border-primary-300 focus:ring-primary-200 focus:ring focus:ring-opacity-50"
                name="message" 
                value="{{ $ticket->message }}" 
                disabled>
                
            </div>

            <div class="mt-4">
                <x-input-label for="categories" :value="__('Category')" />
                <input type="text" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus-within:text-primary-600 focus:border-primary-300 focus:ring-primary-200 focus:ring focus:ring-opacity-50"
                name="categories" 
                value=" @foreach($ticket->categories as $category)
                            {{ $category->name }}
                         @endforeach" 
                disabled>
               
            </div>

            <div class="mt-4">
                <x-input-label for="priority" :value="__('Priority')" />
                <input type="text" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus-within:text-primary-600 focus:border-primary-300 focus:ring-primary-200 focus:ring focus:ring-opacity-50"
                name="priority_id" 
                value="{{ $ticket->priority()->first() ? $ticket->priority()->first()->name:'' }}" 
                disabled>
            </div>

            <div class="mt-4">
                <x-input-label for="assigned_to" :value="__('Assign to')" />
                <input type="text" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus-within:text-primary-600 focus:border-primary-300 focus:ring-primary-200 focus:ring focus:ring-opacity-50"
                name="assigned_to" 
                value="@foreach($ticket->services as $service)
                        {{ $service->name }}
                    @endforeach" 
                disabled>
                
            </div>
{{-- 
            <div class="mt-4">
                <input type="file" name="attachments[]" multiple>
                <x-input-error :messages="$errors->get('attachments')" class="mt-2" />
            </div> --}}

            <div class="mt-4">
            <x-buttons.button class="btn btn-success">
                {{ __('Submit') }}
            </x-buttons.button>
        </div>
        </form>
    </div>
     <!-- / Content -->
    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
                ©
                <script>
                    document.write(new Date().getFullYear());
                </script>
                , made with ❤️ by
                <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Justlearn</a>
            </div>
            <div>
                <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation
                </a
                  >
                <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="footer-link me-4">Support
                </a
                  >
            </div>
        </div>
    </footer>
    <!-- / Footer -->
    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>
<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.services').select2();
            });
        </script>
    @endpush
</x-app-layout>
 