<x-app-layout>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h2 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Tickets /</span> Create Ticket
            </h2>


    <div class="rounded-lg bg-white p-4 shadow-md">

        <form action="{{ route('tickets.storage') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-input type="text"
                              id="title"
                              name="title"
                              class="block w-full"
                              value="{{ old('title') }}"
                              required />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="message" :value="__('Message')" />
                <textarea id="message"
                          name="message"
                          class="mt-1 block h-32 w-full rounded-md border-gray-300 shadow-sm focus-within:text-primary-600 focus:border-primary-300 focus:ring-primary-200 focus:ring focus:ring-opacity-50"
                          required>{{ old('message') }}</textarea>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="categories" :value="__('Categories')" />
                    @foreach($categories as $id => $name)
                        <div class="mt-1 inline-flex space-x-1">
                            <input class="text-purple-600 form-checkbox focus:shadow-outline-purple focus:border-purple-400 focus:outline-none"
                                   type="checkbox" name="categories[]" id="category-{{ $id }}" value="{{ $id }}"
                                    @checked(old('categories') ? in_array($id, old('categories', [])) : $ticket)>
                            <x-input-label for="category-{{ $id }}">{{ $name }}</x-input-label>
                        </div>
                    @endforeach
                <x-input-error :messages="$errors->get('categories')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="priority" :value="__('Priority')" />
                <select name="priority_id" id="priority" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus-within:text-primary-600 focus:border-primary-300 focus:ring-primary-200 focus:ring focus:ring-opacity-50 ">
                    <option value="">-- Select priority --</option>
                    @foreach($priority as $id => $name)
                        <option value="{{ $id }}" {{ (isset($ticket) && $ticket->priority ? $ticket->priority->id : old('priority_id')) == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach 
                </select>
                <x-input-error :messages="$errors->get('priority')" class="mt-2" />
            </div>

                <div class="mt-4">
                    <x-input-label for="assigned_to" :value="__('Assign to')" />
                    <select name="assigned_to[]" id="assigned_to" class="form-control services mt-1 block w-full rounded-md border-gray-300 shadow-sm focus-within:text-primary-600 focus:border-primary-300 focus:ring-primary-200 focus:ring focus:ring-opacity-50" multiple>
                        <option value="">-- Select service --</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" @selected(old('assigned_to', []))>{{ $service->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('assigned_to')" class="mt-2" />
                </div>
            
            {{-- <div class="mt-4">
            
                <input type="file" name="files[]" multiple>
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
                , made with  by
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
