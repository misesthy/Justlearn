<x-app-layout>
    {{-- <x-slot name="header">
        {{ __('Knowledge') }}
    </x-slot>
     --}}
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            @hasrole('admin')
            <h1>Liste des Connaissances</h1>
            <div class="mb-4 flex justify-between">
                <a class="btn btn-success" href="{{ route('knowledges.create') }}">
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
                            <th>Module</th>
                            <th>Name of Module</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($modules as $module)
                       
                            <tr>
                                <td> {{ $module->id ? $module->id:''}}</td>
                                </td>
                                <td> {{ $module->name ? $module->name:''}}</td>
                                <td> {{ $module->description ? $module->description:''}}</td>
                                <td> {{ $module->application->name }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('modules.show', $module->id) }}">
                                                <i class="bx bx-show-alt me-1"></i>
                                                Show
                                            </a>
                                            <a class="dropdown-item" href="{{ route('modules.edit', $module->id) }}">
                                                <i class="bx bx-edit-alt me-1"></i> 
                                                Edit
                                            </a>
                                            <a class="dropdown-item">
                                                <form
                                                    action="{{ route('modules.destroy', $module->id) }}"
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
            @endhasrole
    @hasanyrole('agent|user')
    <div class="site-hero clearfix">
            <div id="header-search" class="site-search clearfix">
                <!-- #header-search -->
                <form action="" method="get" class="search-form" role="search">
                    <div class="form-border" style="border-radius: 0.9rem;">

                        <div class="form-inline">
                            <div class="form-group input-group" style="width: 100%;">
                                <input type="text" name="s" class="search-field form-control input-lg mr-3"
                                    title="Enter search term"
                                    placeholder="Have a question? Type your search term here..." />
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-custom "
                                        style="border-radius: 0.9rem;">Search</button>
                                </span>
                            </div>

                        </div>

                        <div class="search-advance">
                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label for="#" class="col-sm-3 control-label">Category</label>
                                            <div class="col-sm-9">
                                                <select name="category" class="form-control">
                                                    <option value="">-- All Categories --</option>
                                                    <option value="">Account Settings</option>
                                                    <option value="">API Questions</option>
                                                    <option value="">Customization</option>
                                                    <option value="">Mobile Apps</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label for="#" class="col-sm-3 control-label">Format</label>
                                            <div class="col-sm-9">
                                                <select name="format" class="form-control">
                                                    <option value="">-- All Formats --</option>
                                                    <option value="">Text</option>
                                                    <option value="">Image</option>
                                                    <option value="">Video</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- .search-advance -->

                        <a href="#" class="search-advance-button text-center"><i
                                class="fa fa-chevron-circle-up fa-2x"></i></a>

                    </div>
                </form>
            </div><!-- #header-search -->
    </div>
    <div></div>

    <div id="main" class="site-main clearfix">
        <div class="container" style="background-color:#fffbfb;margin-top: -3px;border-radius: 8px;">
            <div class="content-area">
                <div class="row">
                    <div id="content" class="site-content col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                <section class="box-categories">
                                    <h1 class="section-title h4 clearfix">
                                        <i class="fa fa-folder-open fa-fw text-muted"></i>
                                        <small class="pull-right float-right">
                                            <i class="far fa-hdd fa-fw"></i>
                                            25
                                        </small>
                                        <a href="#">Installation and Upgradation</a>
                                    </h1>
                                    <ul class="fa-ul">
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Faveo-Helpdesk Installation on wamp server with Apache</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">How to enable required PHP extension on different server for faveo installation</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Basic server requirements</a>
                                            </h3>
                                        </li>
                                    </ul>
                                    <p class="more-link text-center">
                                        <a href="#" class="btn btn-custom btn-sm">View All</a>
                                    </p>
                                </section>
                            </div>
                            <div class="col-md-6">
                                <section class="box-categories">
                                    <h1 class="section-title h4 clearfix">
                                        <i class="fa fa-folder-open fa-fw text-muted"></i>
                                        <small class="pull-right float-right">
                                            <i class="far fa-hdd fa-fw"></i>
                                            56
                                        </small>
                                        <a href="#">Administrator Guide</a>
                                    </h1>
                                    <ul class="fa-ul">
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">How to create a Helptopic in faveo?</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">How to create teams?</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">How to view a Department profile?</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">How to link Ticket status to Department?</a>
                                            </h3>
                                        </li>
                                    </ul>
                                    <p class="more-link text-center">
                                        <a href="#" class="btn btn-custom btn-sm">View All</a>
                                    </p>
                                </section>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <section class="box-categories">
                                    <h1 class="section-title h4 clearfix">
                                        <i class="fa fa-folder-open fa-fw text-muted"></i>
                                        <small class="pull-right float-right">
                                            <i class="far fa-hdd fa-fw"></i>
                                            8
                                        </small>
                                        <a href="#">Agents Guide</a>
                                    </h1>
                                    <ul class="fa-ul">
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Create common reply to template</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Tickets</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">My tasks</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Tools Knowledge Base</a>
                                            </h3>
                                        </li>
                                        <p class="more-link text-center">
                                            <a href="#" class="btn btn-custom btn-sm">View All</a>
                                        </p>
                                    </ul>
                                </section>
                            </div>
                            <div class="col-md-6">
                                <section class="box-categories">
                                    <h1 class="section-title h4 clearfix">
                                        <i class="fa fa-folder-open fa-fw text-muted"></i>
                                        <small class="pull-right float-right">
                                            <i class="far fa-hdd fa-fw"></i>
                                            10
                                        </small>
                                        <a href="#">Known Issues</a>
                                    </h1>
                                    <ul class="fa-ul">
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">How email will be append as a thread?</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Why emails are not getting fetched in faveo?</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Cant contact to LDAP Sever</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Bug after update from 1.0.7.4 to 1.0.7.5</a>
                                            </h3>
                                        </li>
                                    </ul>
                                    <p class="more-link text-center">
                                        <a href="#" class="btn btn-custom btn-sm">View All</a>
                                    </p>
                                </section>
                            </div>
                            <div class="col-md-6">
                                <section class="box-categories">
                                    <h1 class="section-title h4 clearfix">
                                        <i class="fa fa-folder-open fa-fw text-muted"></i>
                                        <small class="pull-right float-right">
                                            <i class="far fa-hdd fa-fw"></i>
                                            8
                                        </small>
                                        <a href="#">Knowledge Base Known Issues</a>
                                    </h1>
                                    <ul class="fa-ul">
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Creating a customized requester from</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">How to configure a 2FA  enabled Emails?</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Configuring reCaptcha with faveo</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Replying to aTicket thread</a>
                                            </h3>
                                        </li>
                                        <p class="more-link text-center">
                                            <a href="#" class="btn btn-custom btn-sm">View All</a>
                                        </p>
                                    </ul>
                                </section>
                            </div>
                            <div class="col-md-6">
                                <section class="box-categories">
                                    <h1 class="section-title h4 clearfix">
                                        <i class="fa fa-folder-open fa-fw text-muted"></i>
                                        <small class="pull-right float-right">
                                            <i class="far fa-hdd fa-fw"></i>
                                            97
                                        </small>
                                        <a href="#">Releases</a>
                                    </h1>
                                    <ul class="fa-ul">
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Faveo Helpdesk v2.1.8</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Faveo Helpdesk v2.1.7</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Faveo Helpdesk v2.1.7</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Faveo Helpdesk v2.1.6</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Faveo Helpdesk v2.1.5</a>
                                            </h3>
                                        </li>
                                        <p class="more-link text-center">
                                            <a href="#" class="btn btn-custom btn-sm">View All</a>
                                        </p>
                                    </ul>
                                </section>
                            </div>
                            <div class="col-md-6">
                                <section class="box-categories">
                                    <h1 class="section-title h4 clearfix">
                                        <i class="fa fa-folder-open fa-fw text-muted"></i>
                                        <small class="pull-right float-right">
                                            <i class="far fa-hdd fa-fw"></i>
                                            56
                                        </small>
                                        <a href="#">API</a>
                                    </h1>
                                    <ul class="fa-ul">
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Knowledge Base API's</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Webhooks</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Client panel API's</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Forgot Password</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Ticket reply with my thread</a>
                                            </h3>
                                        </li>
                                        <p class="more-link text-center">
                                            <a href="#" class="btn btn-custom btn-sm">View All</a>
                                        </p>
                                    </ul>
                                </section>
                            </div>
                            <div class="col-md-6">
                                <section class="box-categories">
                                    <h1 class="section-title h4 clearfix">
                                        <i class="fa fa-folder-open fa-fw text-muted"></i>
                                        <small class="pull-right float-right">
                                            <i class="far fa-hdd fa-fw"></i>
                                            5
                                        </small>
                                        <a href="#">Plugins & Packages</a>
                                    </h1>
                                    <ul class="fa-ul">
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">LDAP Functionality</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">LDAP configuration and features</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Time tracking and Billing mpodule</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">LDAP Authentication plugins</a>
                                            </h3>
                                        </li>
                                        <li>
                                            <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                            <h3 class="h5">
                                                <a href="#">Podio plugin setup Manual</a>
                                            </h3>
                                        </li>
                                        <p class="more-link text-center">
                                            <a href="#" class="btn btn-custom btn-sm">View All</a>
                                        </p>
                                    </ul>
                                </section>
                            </div>
                            
                            <div class="col-sm-12">
                                <ul class="pagination" style="float: right;">
                                    <li class="page-item">
                                        <a class="page-link" href="#">Previous</a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <section class="section">
                            <div class="banner-wrapper banner-horizontal clearfix">
                                <h4 class="banner-title h3">Need more support?</h4>
                                <div class="banner-content">
                                    <p>If you did not find an answer, please raise a ticket describing the issue.</p>
                                </div>
                                <p>
                                    <a href="{{ route('tickets.create') }}" class="btn btn-custom">Submit Ticket</a>
                                </p>
                            </div>
                        </section>
                    </div>
                    <div id="content" class="site-content col-md-3">
                        <div class="col-md-12">
                            <section id="section-categories" class="section">
                                <h2 class="section-title h4 clearfix">Categories</h2>
                                <ul class="nav nav-pills nav-stacked nav-categories">
                                    <li class="d-flex justify-content-between align-items-center">
                                        <a class="list-group-item list-group-item-action" href="#">
                                            <span class="badge badge-pill pull-right float-right">6</span>
                                            Installation
                                        </a>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                        <a class="list-group-item list-group-item-action" href="#">
                                            <span class="badge badge-pill pull-right float-right">5</span>
                                            Agents guide
                                        </a>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                        <a class="list-group-item list-group-item-action" href="#">
                                            <span class="badge badge-pill pull-right float-right">3</span>
                                            Known issues
                                        </a>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                        <a class="list-group-item list-group-item-action" href="#">
                                            <span class="badge badge-pill pull-right float-right">11</span>
                                            API
                                        </a>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                        <a class="list-group-item list-group-item-action" href="#">
                                            <span class="badge badge-pill pull-right float-right">10</span>
                                            Releases
                                        </a>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                        <a class="list-group-item list-group-item-action" href="#">
                                            <span class="badge badge-pill pull-right float-right">21</span>
                                            Knowledge base
                                        </a>
                                    </li>
                                    <li class="d-flex justify-content-between align-items-center">
                                        <a class="list-group-item list-group-item-action" href="#">
                                            <span class="badge badge-pill pull-right float-right">11</span>
                                            Plugins
                                        </a>
                                    </li>
                                </ul>
                            </section>
                            <!-- #section-categories -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- #main -->
        </div>
    </div>
    @endhasanyrole

    
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