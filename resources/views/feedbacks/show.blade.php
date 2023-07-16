<x-app-layout>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h2 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Feedback /</span> Detail
            </h2>


            @foreach ($feedbacks as $feedback)
                <div class="space-y-4 mb-5">
                    <div class="space-y-4">
                        <div class="mb-3 col-md-3 rounded-lg bg-white p-4 shadow-xs">
                            <p class="text-gray-600">
                            <h4 class="mb-4 font-semibold text-gray-600">
                                Author :
                            </h4>
                            {{-- @dd($feedback->user) --}}
                            {{ $feedback->user->name }}

                            </p>
                        </div>
                        <div class="mb-4 col-md-6 rounded-lg bg-white p-4 shadow-xs">
                            <p class="text-gray-600">
                            <h4 class="mb-4 font-semibold text-gray-600">
                                title feedback :
                            </h4>
                            {{ $feedback->title ? $feedback->title : '' }}
                            </p>
                        </div>
                        <div class="min-w-0 rounded-lg bg-white p-4 shadow-xs">
                            <p class="text-gray-600">
                            <h4 class="mb-4 font-semibold text-gray-600">
                                Description :
                            </h4>
                            {{ $feedback->message ? $feedback->message : '' }}
                            </p>
                        </div>
                    </div>
            @endforeach


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
                    <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                        target="_blank" class="footer-link me-4">Documentation
                    </a>
                    <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank"
                        class="footer-link me-4">Support
                    </a>
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
        $(function() {
            $("#priority").select2();
        })
    </script>
</x-app-layout>
