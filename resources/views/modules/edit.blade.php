<x-app-layout>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h2 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Tickets /</span> Create Ticket
            </h2>


    <div class="rounded-lg bg-white p-4 shadow-md">

        <form action="{{ route('modules.update', $module->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <x-input-label for="name" :value="__('Name of module')" />
                <x-input type="text"
                              id="name"
                              name="name"
                              class="form-control"
                              value="{{ old('name', $module->name) }}"
                              required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="description"
                          name="description"
                          class="mt-1 block h-32 w-full rounded-md border-gray-300 shadow-sm focus-within:text-primary-600 focus:border-primary-300 focus:ring-primary-200 focus:ring focus:ring-opacity-50"
                          required>{{ old('description', $module->description) }}</textarea>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="application_id" :value="__('Application')" />
                <select id="application_id"
                        name="application_id"
                        class="form-control"
                        required>
                    @foreach($application as $id => $name )
                        <option value="{{ $id }}" {{ $id === $module->application_id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-button class="btn btn-primary">
                    {{ __('Submit') }}
                </x-button>
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
  <script>
    $(function () {
        $("#priority").select2();
    })
    
  </script>
</x-app-layout>
