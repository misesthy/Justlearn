<x-app-layout>
    <x-slot name="header">
        Result
    </x-slot>

    <style>
        body {
            margin-top: 20px;
            background: #eee;
        }


        /** Page Search
 *************************************************** **/
        .search-result {
            padding: 20px 0;
            border-bottom: #eee 1px solid;
        }

        .search-result h4 {
            margin: 0;
            line-height: 20px;
        }

        .search-result p {
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .search-result img {
            float: left;
            margin-right: 10px;
            margin-top: 6px;
        }



        /**    17. Panel
 *************************************************** **/
        /* pannel */
        .panel {
            position: relative;

            background: transparent;

            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;

            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
        }

        .panel.fullscreen .accordion .panel-body,
        .panel.fullscreen .panel-group .panel-body {
            position: relative !important;
            top: auto !important;
            left: auto !important;
            right: auto !important;
            bottom: auto !important;
        }

        .panel.fullscreen .panel-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
        }


        .panel>.panel-heading {
            text-transform: uppercase;

            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
        }

        .panel>.panel-heading small {
            text-transform: none;
        }

        .panel>.panel-heading strong {
            font-family: Arial, Helvetica, Sans-Serif;
        }

        .panel>.panel-heading .buttons {
            display: inline-block;
            margin-top: -3px;
            margin-right: -8px;
        }

        .panel-default>.panel-heading {
            padding: 15px 15px;
            background: #fff;
        }

        .panel-default>.panel-heading small {
            color: #9E9E9E;
            font-size: 12px;
            font-weight: 300;
        }

        .panel-clean {
            border: 1px solid #ddd;
            border-bottom: 3px solid #ddd;

            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
        }

        .panel-clean>.panel-heading {
            padding: 11px 15px;
            background: #fff !important;
            color: #000;
            border-bottom: #eee 1px solid;
        }

        .panel>.panel-heading .btn {
            margin-bottom: 0 !important;
        }

        .panel>.panel-heading .progress {
            background-color: #ddd;
        }

        .panel>.panel-heading .pagination {
            margin: -5px;
        }

        .panel-default {
            border: 0;
        }

        .panel-light {
            border: rgba(0, 0, 0, 0.1) 1px solid;
        }

        .panel-light>.panel-heading {
            padding: 11px 15px;
            background: transaprent;
            border-bottom: rgba(0, 0, 0, 0.1) 1px solid;
        }

        .panel-heading a.opt>.fa {
            display: inline-block;
            font-size: 14px;
            font-style: normal;
            font-weight: normal;
            margin-right: 2px;
            padding: 5px;
            position: relative;
            text-align: right;
            top: -1px;
        }

        .panel-heading>label>.form-control {
            display: inline-block;
            margin-top: -8px;
            margin-right: 0;
            height: 30px;
            padding: 0 15px;
        }

        .panel-heading ul.options>li>a {
            color: #999;
        }

        .panel-heading ul.options>li>a:hover {
            color: #333;
        }

        .panel-title a {
            text-decoration: none;
            display: block;
            color: #333;
        }

        .panel-body {
            background-color: #fff;
            padding: 15px;

            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
        }

        .panel-body.panel-row {
            padding: 8px;
        }

        .panel-footer {
            font-size: 12px;
            border-top: rgba(0, 0, 0, 0.02) 1px solid;
            background-color: rgba(0255, 255, 255, 1);

            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
        }

        .text-default {
            color: #c6c6c6 !important;
        }

        .text-danger {
            color: #b92c28 !important;
        }

        .text-warning {
            color: #e38d13 !important;
        }

        .text-info {
            color: #28a4c9 !important;
        }

        .text-primary {
            color: #245580 !important;
        }

        .text-success {
            color: #02B700 !important;
        }

        .result_bloc {
            flex: 1
        }

        @media(max-width:900px) {
            .result_bloc {}

            .conainer-result {
                flex-wrap: wrap;
                row-gap: 20px;
            }
        }
    </style>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h2 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Search /</span> Results for: <span>"{{ request()->s }}"</span>
            </h2>

            <div class="conainer-result" style="display: flex; column-gap:20px;">
                <div class="result_bloc rounded-lg bg-white p-4 shadow-md">
                    <h3>Knowledge Database</h3>
                    <div id="content" class="container">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h6 class="nomargin">
                                    About {{ count($results_knowleges) }} result(s) <small class="text-success">
                                    </small>
                                </h6>
                                <hr class="nomargin-bottom margin-top-10">
                                <!-- SEARCH RESULTS -->

                                @foreach ($results_knowleges as $results_knowlege)
                                    <div class="clearfix search-result">
                                        <!-- item -->
                                        <h4><a href="{{route('knowledge.detail',$results_knowlege->id)}}">{{ $results_knowlege->title }}</a></h4>
                                        <small class="text-success">{{ $results_knowlege->module->name }}</small>
                                        <p>{{ $results_knowlege->short_text }}</p>
                                    </div><!-- /item -->
                                @endforeach



                                <!-- PAGINATION -->
                                {{-- <div class="text-center margin-top-20">
                                    <ul class="pagination">
                                        <li class="disabled"><a href="#">Previous</a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li><a href="#">Next</a></li>
                                    </ul>
                                </div> --}}
                                <!-- /PAGINATION -->

                                @if ($results_knowleges->hasPages())
                                    <div
                                        class="border-t bg-gray-50 px-4 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 sm:grid-cols-9">
                                        {{ $results_knowleges->withQueryString()->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="result_bloc rounded-lg bg-white p-4 shadow-md">
                    <h3>Tickets&Feedbacks Database</h3>
                    <div id="content" class="container">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h6 class="nomargin">
                                    About {{ count($results_tickets) }} result(s) <small class="text-success"> </small>
                                </h6>
                                <hr class="nomargin-bottom margin-top-10">
                                <!-- SEARCH RESULTS -->


                                @foreach ($results_tickets as $results_ticket)
                                    <div class="clearfix search-result">
                                        <!-- item -->
                                        <h4><a href="{{ route('feedbacks.showAll', $results_ticket) }}">{{ $results_ticket->title }}</a></h4>
                                        {{-- <small class="text-success">{{ dd($results_ticket->service)}}</small> --}}
                                        <p>{{ $results_ticket->message }}</p>
                                    </div><!-- /item -->
                                @endforeach




                                @if ($results_tickets->hasPages())
                                    <div
                                        class="border-t bg-gray-50 px-4 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 sm:grid-cols-9">
                                        {{ $results_tickets->withQueryString()->links() }}
                                    </div>
                                @endif

                                <!-- PAGINATION -->
                                {{-- <div class="text-center margin-top-20">
                                    <ul class="pagination">
                                        <li class="disabled"><a href="#">Previous</a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li><a href="#">Next</a></li>
                                    </ul>
                                </div> --}}
                                <!-- /PAGINATION -->
                            </div>
                        </div>

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
                        <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                            target="_blank" class="footer-link me-4">Documentation
                        </a>
                        <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                            target="_blank" class="footer-link me-4">Support
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
</x-app-layout>
