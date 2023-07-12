<x-app-layout>
    <!-- Content wrapper -->
    <div class="content-wrapper">
      <!-- Content -->

      @if ($message = Session::get('success'))
        <div class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-center w-12 bg-green-500">
                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                            d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z">
                    </path>
                </svg>
            </div>

            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                    <span class="font-semibold text-green-500">Success</span>
                    <p class="text-sm text-gray-600">{{ $message }}</p>
                </div>
            </div>
        </div>
    @endif

      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

        <div class="row">
          <div class="col-md-12">
            {{-- <ul class="nav nav-pills flex-column flex-md-row mb-3">
              <li class="nav-item">
                <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
              </li>
            </ul> --}}
            <div class="card mb-4">
              <h5 class="card-header">Profile Details</h5>
              <!-- Account -->
              <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
              <div class="card-body">

                  <div class="d-flex align-items-start align-items-sm-center gap-4">
                      <img
                      src="assets/img/avatar/{{auth()->user()->image}}"
                      alt="user-avatar"
                      class="d-block rounded"
                      height="100"
                      width="100"
                      id="uploadedAvatar"
                      />
                  <div class="button-wrapper">
                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                      <span class="d-none d-sm-block">Upload new photo</span>
                      <i class="bx bx-upload d-block d-sm-none"></i>
                      <input
                        type="file"
                        id="upload"
                        name="image"
                        class="account-file-input"
                        hidden
                        accept="image/png, image/jpeg"
                      />
                    </label>
                    <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                      <i class="bx bx-reset d-block d-sm-none"></i>
                      <span class="d-none d-sm-block">Reset</span>
                    </button>

                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                  </div>
                </div>
              </div>
              <hr class="my-0" />
              <div class="card-body">
                  
                  <div class="row">
                    <div class="mb-3 col-md-6">
                      <x-input-label for="name" :value="__('Name')" />
          <x-input type="text"
                        id="name"
                        name="name"
                        class="block w-full"
                        value="{{ old('name', auth()->user()->name) }}"
                        required />
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    
                    <div class="mb-3 col-md-6">
                        <x-input-label for="email" :value="__('Email')"/>
                        <x-input name="email"
                                 type="email"
                                 class="block w-full"
                                 value="{{ old('email', auth()->user()->email) }}"
                                 required/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <x-input-label for="password" :value="__('New password')"/>
                        <x-input type="password"
                                 name="password"
                                 class="block w-full" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                  
                    <div class="mb-3 col-md-6">
                        <x-input-label id="password_confirmation" :value="__('New password confirmation')"/>
                        <x-input type="password"
                                 name="password_confirmation"
                                 class="block w-full" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <x-button class="block w-full">
                            {{ __('Submit') }}
                        </x-button>
                    </div>
                
                </form>
              </div>
              <!-- /Account -->
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
            , made with ❤️ by
            <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Justlearn</a>
          </div>
          <div>
            <a
              href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
              target="_blank"
              class="footer-link me-4"
              >Documentation</a
            >

            <a
              href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
              target="_blank"
              class="footer-link me-4"
              >Support</a
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