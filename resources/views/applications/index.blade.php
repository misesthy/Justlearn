<x-app-layout>
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h1>Liste des applications</h1>
            <div class="mb-4 flex justify-between">
                <a class="btn btn-success" href="{{ route('applications.create') }}">
                    {{ __('Create') }}
                </a>
            </div>
            <!-- Basic Bootstrap Table -->
            <div class="card">
                {{-- <div class="table-responsive text-nowrap"> --}}
                    <table class="table">
                        <thead>
                            <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                <th>N°</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($applications as $application)
                                <tr>
                                    <td> {{ $application->id ? $application->id:''}}</td>
                                    </td>
                                    <td> {{ $application->name ? $application->name:''}}</td>
                                    <td> {{ $application->description ? $application->description:''}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('applications.show', $application->id) }}">
                                                    <i class="bx bx-show-alt me-1"></i>
                                                    Show
                                                </a>
                                                <a class="dropdown-item" href="{{ route('applications.edit', $application->id) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> 
                                                    Edit
                                                </a>
                                                <a class="dropdown-item">
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
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
                        , made with  by
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
