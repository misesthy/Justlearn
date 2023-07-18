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
            @hasrole('admin|agent')
                <div class="mb-4 flex justify-between">
                    <a class="btn btn-primary" href="{{ route('knowledges.create') }}">
                         {{ __('Create Knowledge') }}
                     </a>
                           
                </div>
            @endhasrole
         <!-- Basic Bootstrap Table -->
         <div class="card">
            {{-- <div class="table-responsive text-nowrap"> --}}
            <table class="table">
                    <thead>
                        <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th>N°</th>
                            <th>Titles</th>
                            <th>Descriptions</th>
                            <th>Modules</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($knowledges as $knowledge)
                            <tr>
                                <td> {{ $knowledge->id ? $knowledge->id:''}}</td>
                                </td>
                                <td> {{ $knowledge->title ? $knowledge->title:''}}</td>
                                <td> {{ $knowledge->short_text ? $knowledge->short_text:''}}</td>
                                <td> {{ $knowledge->module->name }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('knowledges.show', $knowledge->id) }}">
                                                <i class="bx bx-show-alt me-1"></i>
                                                Show
                                            </a>
                                            <a class="dropdown-item" href="{{ route('knowledges.edit', $knowledge->id) }}">
                                                <i class="bx bx-edit-alt me-1"></i> 
                                                Edit
                                            </a>
                                            <a class="dropdown-item">
                                                <form
                                                    action="{{ route('knowledges.destroy', $knowledge->id) }}"
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
                <form action="{{ route('search.index') }}" method="get" class="search-form" role="search">
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
                                            <label for="#" class="col-sm-3 control-label">Module</label>
                                            <div class="col-sm-9">
                                                <select name="module" class="form-control">
                                                    <option value="">-- All Modules --</option>
                                                    @foreach ($modules as $module)
                                                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-sm-6">
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
                                </div> --}}

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
                            @foreach ($modules as $module)
                            <div class="col-md-6">
                                <section class="box-categories">
                                    <h1 class="section-title h4 clearfix">
                                        <i class="fa fa-folder-open fa-fw text-muted"></i>
                                        <small class="pull-right float-right">
                                            <i class="far fa-hdd fa-fw"></i>
                                            {{ $module->knowledges()->count() }}
                                        </small>
                                        <a href="#">{{ $module->name }}</a>
                                    </h1>
                                    <ul class="fa-ul">
                                        @foreach ($module->knowledges as $knowledge)
                                        @if ($loop->index < 4)
                                                <li>
                                                    <i class="fa-li fa fa-list-alt fa-fw text-muted"></i>
                                                    <h3 class="h5">
                                                        <a href="{{route('knowledge.detail',$knowledge->id)}}">{{ $knowledge->title }}</a>
                                                    </h3>
                                                </li>
                                            @endif
                                        @endforeach
                                        <p class="more-link text-center">
                                            <a href="{{ '/knowledge/'.$module->id }}" class="btn btn-custom btn-sm">View All</a>
                                        </p>
                                    </ul>
                                </section>
                            </div>
                            @endforeach
                            <div class="col-sm-12">
                                <ul class="pagination" style="float: right;">
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $modules->previousPageUrl() }}">Previous</a>
                                    </li>
                            
                                    @foreach ($modules->getUrlRange(1, $modules->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $modules->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                            
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $modules->nextPageUrl() }}">Next</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @hasrole('agent')
                            <div class="mb-4 flex justify-between">
                                
                                <a class="btn btn-primary" href="{{ route('knowledges.create') }}">
                                    {{ __('Create Knowledge') }}
                                </a>
                            
                            </div>
                        @endhasrole
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
                            <section id="section-modules" class="section">
                                <h2 class="section-title h4 clearfix">Modules</h2>
                                <ul class="nav nav-pills nav-stacked nav-categories list-group">
                                    @foreach ($modules as $module)
                                    <li class="d-flex justify-content-between align-items-center">
                                        <a class="list-group-item list-group-item-action" href="#">
                                            <span class="badge badge-pill pull-right float-right">{{ $module->knowledges()->count() }}</span>
                                            {{ $module->name }}
                                        </a>
                                    </li>
                                    @endforeach
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