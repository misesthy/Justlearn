<x-app-layout>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h2 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Knowledges /</span> Create Knowledge
            </h2>


            <div class="rounded-lg bg-white p-4 shadow-md">

                <form action="{{ route('knowledges.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{--         
            <div class="form-group">
                <label for="domain">Domaine de connaissance</label>
                <select name="domain" id="domain" class="form-control">
                    <option value="">Sélectionner un domaine</option>
                    @foreach ($domains as $domain)
                        <option value="{{ $domain->id }}">{{ $domain->name }}</option>
                    @endforeach
                </select>
            </div> --}}

                    <div class="form-group">
                        <label for="application_id">Application :</label>
                        <select name="application_id" id="application_id" class="form-control">
                            <option value="">Sélectionnez une application</option>
                            @foreach ($applications as $application)
                                <option value="{{ $application->id }}">{{ $application->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="module_id">Module :</label>
                        <select name="module_id" id="module_id" class="form-control" disabled>
                            <option value="">Sélectionnez un module</option>
                        </select>
                    </div>

                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-input type="text" id="title" name="title" class="block w-full"
                            value="{{ old('title') }}" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="short_text" :value="__('Resume')" />
                        <textarea id="short_text" name="short_text"
                            class="mt-1 block h-32 w-full rounded-md border-gray-300 shadow-sm focus-within:text-primary-600 focus:border-primary-300 focus:ring-primary-200 focus:ring focus:ring-opacity-50"
                            required>{{ old('short_text') }}</textarea>
                        <x-input-error :messages="$errors->get('short_text')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="full_text" :value="__('Description')" />
                        <textarea id="full_text" name="full_text"
                            class="mt-1 block h-32 w-full rounded-md border-gray-300 shadow-sm focus-within:text-primary-600 focus:border-primary-300 focus:ring-primary-200 focus:ring focus:ring-opacity-50"
                            >{{ old('full_text') }}</textarea>
                        <x-input-error :messages="$errors->get('full_text')" class="mt-2" />
                    </div>

                    <div class="button-wrapper mt-5">
                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload file</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" id="upload" name="file" class="account-file-input" hidden />
                        </label>
                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                        </button>

                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                    </div>

                    <button type="submit" class="btn btn-primary mt-5">Enregistrer</button>
                </form>


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
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#application_id').on('change', function() {
                    var applicationId = $(this).val();
                    
                    var moduleSelect = $('#module_id');
                    // Clear existing options
                    moduleSelect.empty();

                    if (applicationId) {
                        $.ajax({
                            url: '/api/module_by_application/' + applicationId,
                            type: 'GET',
                            success: function(response) {
                                $('#module_id').prop('disabled', false);

                                // Add modules to select options
                                $.each(response.modules, function(index, module) {
                                    var option = $('<option>').val(module.id).text(module
                                        .name);
                                    moduleSelect.append(option);
                                });
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
 