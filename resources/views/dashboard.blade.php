<x-app-layout>
                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                        <!-- Content -->
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="row">
                                <div class="col-lg-8 mb-4 order-0">
                                    <div class="card">
                                        <div class="d-flex align-items-end row">
                                            <div class="col-sm-7">
                                                <div class="card-body">
                                                    <h5 class="card-title text-primary">Welcome  {{ auth()->user()->name }} ! 🎉</h5>
                                                    <p class="mb-4">
                                                        You have successfully
                                                        <span class="fw-bold"></span>
                                                        connected
                                                    </p>
                                                    {{-- <a href="javascript:;" class="btn btn-sm btn-outline-primary"> View </a> --}}
                                                </div>
                                            </div>
                                            <div class="col-sm-5 text-center text-sm-left">
                                                <div class="card-body pb-0 px-0 px-md-4">
                                                    <img
                                                        src="{{asset('assets/img/illustrations/man-with-laptop-light.png')}}"
                                                        height="140"
                                                        alt="View Badge User"
                                                        data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                                        data-app-light-img="illustrations/man-with-laptop-light.png"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 order-1">
                                    <div class="row">
                                        {{-- Total tickets --}}
                                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-between">
                                                        <a href="{{ route('dashboard') }}" class="menu-link">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{asset('assets/img/icons/unicons/all-ticket.svg')}}" alt="chart success" class="rounded">
                                                        </div>
                                                        </a>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn p-0"
                                                                type="button"
                                                                id="cardOpt3"
                                                                data-bs-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false"
                                                            >
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="fw-semibold d-block mb-1">Total tickets</span>
                                                    <h3 class="card-title mb-2"> {{ $totalTickets }}</h3>
                                                    <small class="text-success fw-semibold">
                                                        {{-- <i class="bx bx-up-arrow-alt"></i>  --}}
                                                        {{ $percentagePreviousDay }} % /day &
                                                        {{ $percentagePreviousMonth }} % /month
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        {{--/ Total tickets --}}
                                        {{-- Opened tickets --}}
                                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-between">
                                                        <a href="{{ route('dashboard') }}" class="menu-link">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{asset('assets/img/icons/unicons/open-ticket.svg')}}" alt="Credit Card" class="rounded">
                                                        </div>
                                                        </a>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn p-0"
                                                                type="button"
                                                                id="cardOpt6"
                                                                data-bs-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false"
                                                            >
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="fw-semibold d-block mb-1">Opened tickets</span>
                                                    <h3 class="card-title text-nowrap mb-1"> {{ $openTickets }}</h3>
                                                    {{-- <small class="text-success fw-semibold">
                                                        <i class="bx bx-up-arrow-alt"></i> +28.42%
                                                    </small> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/  Opened tickets -->
                                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                                    <div class="card">
                                        <div class="row row-bordered g-0">
                                            <div class="col-md">
                                                <h5 class="card-header m-0 me-2 pb-3">Total Tickets</h5>
                                                <div id="ticketCreationChart"></div>
                                            </div>
                                            <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
                                            <script>
                                                var ticketsPerDay = {!! json_encode($ticketsPerDay) !!};
                                                var ticketsPerMonth = {!! json_encode($ticketsPerMonth) !!};
                                                var options = {
                                                    chart: {
                                                        type: 'area',
                                                        height: 350
                                                    },
                                                    series: [
                                                        {
                                                            name: 'Tickets par jour',
                                                            data: Object.values(ticketsPerDay)
                                                        },
                                                        {
                                                            name: 'Tickets par mois',
                                                            data: Object.values(ticketsPerMonth)
                                                        }
                                                    ],
                                                    xaxis: {
                                                        categories: Object.keys(ticketsPerDay)
                                                    }
                                                };
                                                var chart = new ApexCharts(document.querySelector('#ticketCreationChart'), options);
                                                chart.render();
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Total Searh -->
                                <!-- deleted tickets -->
                                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                                    <div class="row">
                                        <div class="col-6 mb-4">
                                            
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-between">
                                                        <a href="{{ route('dashboard') }}" class="menu-link">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{asset('assets/img/icons/unicons/ongoing-ticket.svg')}}" alt="Credit Card" class="rounded">
                                                        </div>
                                                        </a>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn p-0"
                                                                type="button"
                                                                id="cardOpt4"
                                                                data-bs-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false"
                                                            >
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                                {{-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="d-block mb-1">Deleted tickets</span>
                                                    <h3 class="card-title text-nowrap mb-2">{{ $deletedTickets }}</h3>
                                                    {{-- <small class="text-danger fw-semibold">
                                                        <i class="bx bx-down-arrow-alt"></i> -14.82%
                                                    </small> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ Deleted Tickets -->

                                        <div class="col-6 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-between">
                                                        
                                            <a href="{{ route('dashboard') }}" class="menu-link">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{asset('assets/img/icons/unicons/close-ticket.svg')}}" alt="Credit Card" class="rounded">
                                                        </div>
                                            </a>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn p-0"
                                                                type="button"
                                                                id="cardOpt1"
                                                                data-bs-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false"
                                                            >
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="fw-semibold d-block mb-1">Closed tickets</span>
                                                    <h3 class="card-title mb-2">{{ $closedTickets }}</h3>
                                                    {{-- <small class="text-success fw-semibold">
                                                        <i class="bx bx-up-arrow-alt"></i> +28.14%
                                                    </small> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6 mb-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="card-title d-flex align-items-start justify-content-between">
                                                            <a href="{{ route('dashboard') }}" class="menu-link">
                                                            <div class="avatar flex-shrink-0">
                                                                <img src="{{asset('assets/img/icons/unicons/all-user.svg')}}" alt="Credit Card" class="rounded">
                                                            </div>
                                                            </a>
                                                                <div class="dropdown">
                                                                <button
                                                                    class="btn p-0"
                                                                    type="button"
                                                                    id="cardOpt1"
                                                                    data-bs-toggle="dropdown"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false"
                                                                >
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                                </div>
                                                            </div>
                                                         </div>
                                                            <span class="fw-semibold d-block mb-1">Total users</span>
                                                             <h3 class="card-title mb-2">{{ $totalUsers }}</h3>
                                                            {{-- <small class="text-success fw-semibold">
                                                                <i class="bx bx-up-arrow-alt"></i> +28.14%
                                                            </small> --}}
                                                        </div>
                                                    </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                                            <a href="{{ route('dashboard') }}" class="menu-link">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-between">
                                                        <a href="{{ route('dashboard') }}" class="menu-link">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{asset('assets/img/icons/unicons/delete-user.svg')}}" alt="Credit Card" class="rounded">
                                                        </div>
                                                        </a>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn p-0"
                                                                type="button"
                                                                id="cardOpt6"
                                                                data-bs-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false"
                                                            >
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="fw-semibold d-block mb-1">Deleted users</span>
                                                    <h3 class="card-title text-nowrap mb-2">{{ $deletedUsers }}</h3>
                                                    {{-- <small class="text-success fw-semibold">
                                                        <i class="bx bx-up-arrow-alt"></i> +28.14%
                                                    </small> --}}
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                        
                                       
                                    </div>
                                </div>
                                <!--/ deleted tickets -->
                            </div>
                            <div class="row">
                                <!-- Order Statistics -->
                                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                            <div class="card-title mb-0">
                                                <h5 class="m-0 me-2">Order Statistics</h5>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="userTicketsDonutChart"></div>
                                            <div class="legend">
                                                <h4>Explication des parties :</h4>
                                                <ul>
                                                    @foreach($data as $item)
                                                        <li>
                                                            <span class="legend-label">{{ $item['label'] }}</span>
                                                            <span class="legend-value">({{ $item['value'] }} tickets)</span>
                                                        </li>
                                                        <hr class="legend-divider">
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
                                            <script>
                                                var chartData = {!! json_encode($data) !!};

                                                var seriesData = chartData.map(function(item) {
                                                    return item.value;
                                                });

                                                var options = {
                                                    chart: {
                                                        type: 'donut',
                                                        height: 250
                                                    },
                                                    series: seriesData,
                                                    labels: chartData.map(function(item) {
                                                        return item.label;
                                                    }),
                                                    responsive: [{
                                                        breakpoint: 480,
                                                        options: {
                                                            chart: {
                                                                width: 500
                                                            },
                                                            legend: {
                                                                position: 'bottom'
                                                            }
                                                        }
                                                    }]
                                                };

                                                var chart = new ApexCharts(document.querySelector('#userTicketsDonutChart'), options);
                                                chart.render();
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Order Statistics -->
                                {{-- <!-- Expense Overview -->
                                <div class="col-md-6 col-lg-4 order-1 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <ul class="nav nav-pills" role="tablist">
                                                <li class="nav-item">
                                                    <button
                                                        type="button"
                                                        class="nav-link active"
                                                        role="tab"
                                                        data-bs-toggle="tab"
                                                        data-bs-target="#navs-tabs-line-card-income"
                                                        aria-controls="navs-tabs-line-card-income"
                                                        aria-selected="true"
                                                    >
                                                        Income
                                                    </button>
                                                </li>
                                                <li class="nav-item">
                                                    <button type="button" class="nav-link" role="tab">Expenses</button>
                                                </li>
                                                <li class="nav-item">
                                                    <button type="button" class="nav-link" role="tab">Profit</button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body px-0">
                                            <div class="tab-content p-0">
                                                <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                                                    <div class="d-flex p-4 pt-3">
                                                        <div class="avatar flex-shrink-0 me-3">
                                                            <img src="../assets/img/icons/unicons/wallet.png" alt="User">
                                                        </div>
                                                        <div>
                                                            <small class="text-muted d-block">Total Balance</small>
                                                            <div class="d-flex align-items-center">
                                                                <h6 class="mb-0 me-1">$459.10</h6>
                                                                <small class="text-success fw-semibold">
                                                                    <i class="bx bx-chevron-up"></i>
                                                                    42.9%
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="incomeChart"></div>
                                                    <div class="d-flex justify-content-center pt-4 gap-2">
                                                        <div class="flex-shrink-0">
                                                            <div id="expensesOfWeek"></div>
                                                        </div>
                                                        <div>
                                                            <p class="mb-n1 mt-1">Expenses This Week</p>
                                                            <small class="text-muted">$39 less than last week</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Expense Overview --> --}}
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
                                    </a>
                                    <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="footer-link me-4">
                                        Support
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
    </div>
</x-app-layout>      