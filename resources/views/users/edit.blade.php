<x-app-layout>
    <!-- Content wrapper -->
    <div class="content-wrapper">
      <!-- Content -->
  
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

        <div class="row">
          <div class="col-md-12">
            <div class="card mb-4">
              <h5 class="card-header">Profile Details</h5>
              <!-- Account -->
              <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
              <div class="card-body">

                  <div class="d-flex align-items-start align-items-sm-center gap-4">
                      <img
                      src=" /assets/img/avatar/{{ $user->image }}"
                      alt="user-avatar"
                      class="d-block rounded"
                      height="100"
                      width="100"
                      id="uploadedAvatar"
                      />
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
                        value="{{ old('name', $user->name) }}"
                        required />
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    
                    <div class="mb-3 col-md-6">
                        <x-input-label for="email" :value="__('Email')"/>
                        <x-input name="email"
                                 type="email"
                                 class="block w-full"
                                 value="{{ old('email', $user->email) }}"
                                 required/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-input type="password"
                                      id="password"
                                      name="password"
                                      class="block w-full"
                                      value="{{ old('password') }}" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />        
                    </div>
                    <div class="mb-3 col-md-6">
                        <x-input-label for="services" :value="__('Services')" />
                        <div class="space-x-2">
                                <div class="inline-flex space-x-1">
                                  {{-- <select name="service">
                                    @foreach ($services as $service)
                                      <option value="{{$service->id}}" {{ $service->id == $user->service_id ? 'selected' : '' }}>{{ $service->name }}</option>
                                    @endforeach
                                  </select> --}}
                                  <select name="services[]" id="services" class="form-control services text-purple-600 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple" multiple>
                                    <option value="">-- Select service --</option>
                                    @foreach ($services as $service)
                                      <option value="{{ $service->id }}" @selected(in_array($id, old('services',[]))|| isset($user) && 'selected' : '') >
                                        {{ $service->name }}
                                      </option>
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
                                        {{-- {{dd($id == old('role', $user->roles->contains($id)))}} --}}
                                        <input class="text-purple-600 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple" type="radio" name="role" id="role-{{ $id }}" value="{{ $id }}" {{ $user->roles->contains($id) ? 'checked' : '' }}>
                                        <label class="text-sm text-gray-700" for="role-{{ $id }}">{{ $name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('role')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
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
@push('scripts')
<script>
  $(document).ready(function() {
    $('.services').select2();
  });
</script>
@endpush
</x-app-layout>