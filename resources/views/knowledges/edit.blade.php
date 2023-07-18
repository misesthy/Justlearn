<x-app-layout>
    <x-slot name="header">
        {{ __('Knowledge') }}
    </x-slot>

     <!-- Content wrapper -->
     <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h2 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Tickets /</span> Create Ticket
            </h2>


    <div class="rounded-lg bg-white p-4 shadow-md">
        <form action="{{ route('knowledge.update', $knowledge->id) }}" method="POST">
            @csrf
            @method('PUT')
        
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" value="{{ $knowledge->name }}" class="form-control">
            </div>
        
            <div class="form-group">
                <label for="module_id">Module</label>
                <select name="module_id" id="module_id" class="form-control">
                    @foreach($modules as $module)
                        <option value="{{ $module->id }}" {{ $knowledge->module_id == $module->id ? 'selected' : '' }}>
                            {{ $module->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        
            <!-- Ajoutez les autres champs de formulaire pour l'édition de la connaissance -->
        
            <button type="submit" class="btn btn-primary">Enregistrer</button>
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
</x-app-layout>        