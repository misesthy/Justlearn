<x-app-layout>
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Account Settings /</span>
                Account
            </h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">

                        <h5 class="card-header"> Details</h5>
                        <!-- Account -->
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img
                                    alt="user-avatar"
                                    class="d-block rounded"
                                    height="100"
                                    width="100"
                                    src="/assets/img/avatars/{{ $user->avatar  ? $user->avatar:''  }}"
                                >
                            </div>
                        </div>
                        <hr class="my-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <x-input-label for="name" :value="__('Name')"/>
                                    <span> {{ $user->name  ? $user->name:'' }}</span>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <x-input-label for="email" :value="__('Email')"/>
                                    <span> {{ $user->email  ? $user->email:'' }}</span>
                                </div>
                                
                                <div class="mb-3 col-md-6">
                                    <x-input-label for="services" :value="__('Service')"/>
                                    @if (!is_null($user->service) )
                                        <span class="label label-info label-many">{{$user->service->name}}</span>
                                    @else
                                        
                                        @foreach($user->services as $service)
                                            <span class="rounded-full bg-gray-50 px-2 py-2">
                                                    {{ $service->name }}
                                            </span> 
                                        @endforeach
                                    @endif
                                    
                                </div>
                                <div class="mb-3 col-md-6">
                                    <x-input-label for="roles" :value="__('Role')"/>
                                    @foreach($user->roles as $roles)
                                    <span class="label label-info label-many">{{ $roles->name }}</span>
                                    @endforeach
                                </div>
                                <div class="mb-3 col-md-6">
                                    {{-- <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                                        {{ _(gyrc) }}
                                    </a> --}}
                                </div>
                            </div>
                            <!-- /Account -->
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
</x-app-layout>
