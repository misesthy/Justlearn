<x-app-layout>
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h2 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Tickets /</span>
                Create Ticket
            </h2>
            <div class="rounded-lg bg-white p-4 shadow-md">
                <form action="{{ route('application.update', $application->id) }}" method="POST">
                    @csrf
            @method('PUT')
                    <div class="form-group">
                        <label for="nom">Nom de l'application</label>
                        <input
                            type="text"
                            name="nom"
                            id="nom"
                            value="{{ $application->nom }}"
                            class="form-control"
                        >
                    </div>
                    <!-- Ajoutez les autres champs de formulaire pour la modification de l'application -->
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
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
                        <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4">
                            Documentation
                        </a
                  >
                        <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="footer-link me-4">
                            Support
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