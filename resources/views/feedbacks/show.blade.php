<x-app-layout>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h2 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Feedback /</span> Detail
            </h2>

            <div style="margin-bottom:50px">
                <p><b>Ticket title :</b> {{ $ticket->title }}</p>
                <p><b>Ticket message :</b> {{ $ticket->message }}</p>
                <p><b>Ticket status :</b> <span style="color: {{ $ticket->status->name == 'Closed' ? '#f00' : ($ticket->status->name == 'Open' ? '#006400' : '')  }}; font-weight:{{ $ticket->status->name == 'Closed' ? '700' : ($ticket->status->name == 'Open' ? '700' : '')  }}">{{  $ticket->status->name }}</span></p>
                {{-- <hr> --}}
            </div>


            @if (count($feedbacks) == 0)
                <span>No Feedback found for this ticket.</span>
            @endif

            @foreach ($feedbacks as $feedback)
            <div style="display: flex; align-items:center; gap:20px">
                <hr style="flex: 1"> Feedback by: {{ $feedback->user->name }} <hr style="flex: 1">
            </div>

                <div class="space-y-4 mb-5">
                    <div class="space-y-4">
                        {{-- <div class="mb-3 col-md-3 rounded-lg bg-white p-4 shadow-xs">
                            <p class="text-gray-600">
                            <h4 class="mb-4 font-semibold text-gray-600">
                                Author :
                            </h4>
                            {{ $feedback->user->name }}
                            </p>
                        </div> --}}
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

                    <a href="/chat/{{ $feedback->user->id }}"
                        style="display: inline-block; margin-top: 15px;margin-bottom: 15px;display:flex; justify-content:flex-end">
                        <span>Send message to {{ $feedback->user->name }}</span>
                        <svg style="margin-left: 10px; color:inherit; position: relative; top:4px" height="16px" width="16px" version="1.1" id="Layer_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 458 458" xml:space="preserve">
                            <g>
                                <g>
                                    <path
                                        d="M428,41.534H30c-16.569,0-30,13.431-30,30v252c0,16.568,13.432,30,30,30h132.1l43.942,52.243
			c5.7,6.777,14.103,10.69,22.959,10.69c8.856,0,17.258-3.912,22.959-10.69l43.942-52.243H428c16.568,0,30-13.432,30-30v-252
			C458,54.965,444.568,41.534,428,41.534z M323.916,281.534H82.854c-8.284,0-15-6.716-15-15s6.716-15,15-15h241.062
			c8.284,0,15,6.716,15,15S332.2,281.534,323.916,281.534z M67.854,198.755c0-8.284,6.716-15,15-15h185.103c8.284,0,15,6.716,15,15
			s-6.716,15-15,15H82.854C74.57,213.755,67.854,207.039,67.854,198.755z M375.146,145.974H82.854c-8.284,0-15-6.716-15-15
			s6.716-15,15-15h292.291c8.284,0,15,6.716,15,15C390.146,139.258,383.43,145.974,375.146,145.974z" />
                                </g>
                            </g>
                        </svg>
                    </a>
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
                    , made with by
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
