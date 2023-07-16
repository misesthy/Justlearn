<x-app-layout>
    <!-- Content wrapper -->
    <div class="content-wrapper">
      <!-- Content -->

      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

        <div class="row">
          <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
              <li class="nav-item">
                <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
              </li>
            </ul>
            <div class="card mb-4">
               <!-- Account -->
               <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
             

                  <div class="d-flex align-items-start align-items-sm-center gap-4">
                      <img
                      src="..storage\users-avatar1.png"
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
                        value="{{ old('name') }}"
                        required />
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    
                    <div class="mb-3 col-md-6">
                        <x-input-label for="email" :value="__('Email')"/>
                        <x-input name="email"
                                 type="email"
                                 class="block w-full"
                                 value="{{ old('email') }}"
                                 required/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <x-input-label for="password" :value="__('Password')"/>
                        <x-input type="password"
                                 name="password"
                                 class="block w-full"
                                 value="{{ old('password') }}"
                                 required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="mb-3 col-md-6">
                      <x-input-label for="service" :value="__('Services')" />
                      <div class="space-x-2">
                              <div class="inline-flex space-x-1">
                                <select name="service_id" >
                                  @foreach ($service as $id => $name)
                                    <option value="{{$id}}">{{ $name }}</option>
                                  @endforeach
                                </select>
                              </div>
                      </div>
                      @error('service')
                          <span class="text-sm text-red-600">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <x-input-label for="role" :value="__('Role')" />
                        <div class="space-x-2">
                            @foreach($roles as $id => $name)
                                <div class="inline-flex space-x-1">
                                    <input class="text-purple-600 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple" 
                                      type="radio" name="role" id="role-{{ $id }}" 
                                      value="{{ $id }}" @checked($id == old('role') || $name == 'user')>
                                    <label class="text-sm text-gray-700" for="role-{{ $id }}">{{ $name }}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('role')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
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