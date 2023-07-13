<x-app-layout>
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
           
            <div class="rounded-lg bg-white p-4 shadow-md">
                <h2>Détails de l'application</h2>

                <div class="min-w-0  rounded-lg bg-white p-4 shadow-xs">
                    <p class="text-gray-600">
                        <h4 class="mb-4 font-semibold text-gray-600">
                            Name : 
                        </h4>
                        {{ $application->name }}
                    </p>
                </div>
                <div class="min-w-0 rounded-lg bg-white p-4 shadow-xs">
                    <p class="text-gray-600">
                        <h4 class="mb-4 font-semibold text-gray-600">
                            Description : 
                        </h4>
                        {{ $application->description }}
                    </p>
                </div>
               <div>
                    <a class="dropdown-item" href="{{ route('applications.edit', $application->id) }}">
                        <i class="bx bx-edit-alt me-1"></i> 
                        Edit
                    </a>
                </div>
                <form
                    action="{{ route('applications.destroy', $application->id) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure?')"
                    style="display: inline-block;"
                    >
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-block btn-primary btn-login">
                             Delete
                        </button>
                </form>
            </div>
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
