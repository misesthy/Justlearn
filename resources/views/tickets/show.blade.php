<x-app-layout>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
    <x-slot name="header">
        {{ $ticket->title }}
    </x-slot>

    {{-- @hasanyrole('admin|agent')
        <div class="mb-4 flex justify-end">
            @if($ticket->isOpen())
                <form action="{{ route('tickets.close', $ticket) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('PATCH')
                    <x-buttons.button>
                        Close
                    </x-buttons.button>
                </form>
            @elseif(!$ticket->isArchived())
                <form action="{{ route('tickets.reopen', $ticket) }}" method="POST" class="mr-2" style="display: inline-block;">
                    @csrf
                    @method('PATCH')
                    <x-buttons.button>
                        Reopen
                    </x-buttons.button>
                </form>

                <form action="{{ route('tickets.archive', $ticket) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('PATCH')
                    <x-buttons.button>
                        Archive
                    </x-buttons.button>
                </form>
            @endif
        </div>
    @endhasanyrole --}}

    <div class="space-y-4">
        <div class="mb-3 col-md-3 rounded-lg bg-white p-4 shadow-xs">
            <p class="text-gray-600">
                <h4 class="mb-4 font-semibold text-gray-600">
                    Author : 
                </h4>
                {{ $ticket->user->name }}
            </p>
        </div>
        <div class="mb-4 col-md-6 rounded-lg bg-white p-4 shadow-xs">
            <p class="text-gray-600">
                <h4 class="mb-4 font-semibold text-gray-600">
                    status : 
                </h4>
                {{  $ticket->status()->first() ? $ticket->status()->first()->name:'' }}
            </p>
        </div>
        <div class="mb-4 col-md-6 rounded-lg bg-white p-4 shadow-xs">
            <p class="text-gray-600">
                <h4 class="mb-4 font-semibold text-gray-600">
                    Priority : 
                </h4>
                {{  $ticket->priority()->first() ? $ticket->priority()->first()->name:'' }}
            </p>
        </div>
        <div class="mb-4 col-md-6 rounded-lg bg-white p-4 shadow-xs">
            <p class="text-gray-600">
                <h4 class="mb-4 font-semibold text-gray-600">
                    Categorie : 
                </h4>
                @foreach($ticket->categories as $category)
                    {{ $category->name }}
                    <br>
            @endforeach
        </div>
        
        <div class="mb-4 col-md-6 rounded-lg bg-white p-4 shadow-xs">
            <p  class="text-gray-600">
                <h4 class="mb-4 font-semibold text-gray-600">
                    Service : 
                </h4> 
                @foreach($ticket->services as $service)
                        {{ $service->name }}
                        <br>
                @endforeach
            </p>
        </div>
        <div class="min-w-0 rounded-lg bg-white p-4 shadow-xs">
            <p class="text-gray-600">
                <h4 class="mb-4 font-semibold text-gray-600">
                    Description : 
                </h4>
                {{ $ticket->message}}
            </p>
        </div>
        {{-- @if($ticket->getMedia('tickets_attachments')->count())
            <div class="min-w-0 rounded-lg bg-white p-4 shadow-xs">
                <h4 class="mb-4 font-semibold text-gray-600">
                    Attachments
                </h4>

                @foreach($ticket->getMedia('tickets_attachments') as $media)
                    <p>
                        <a href="{{ route('attachment-download', $media) }}" class="hover:underline">{{ $media->file_name }}</a>
                    </p>
                @endforeach
            </div>
        @endif --}}
        {{-- <div class="min-w-0 rounded-lg bg-white p-4 shadow-xs space-y-4">
            @if(!$ticket->isArchived())
                <form action="{{ route('message.store', $ticket) }}" method="POST">
                    @csrf

                    <div>
                        <textarea id="message"
                                  name="message"
                                  class="mt-1 block h-32 w-full rounded-md border-gray-300 shadow-sm focus-within:text-primary-600 focus:border-primary-300 focus:ring-primary-200 focus:ring focus:ring-opacity-50"
                                  required>{{ old('message') }}</textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    </div>

                    <x-buttons.button class="mt-4">
                        Submit
                    </x-buttons.button>
                </form>
            @endif
            @forelse($ticket->messages as $message)
                <p class="rounded-lg bg-gray-50 p-3">{{ $message->message }}</p>
            @empty
                <p class="text-gray-600">
                    No messages found.
                </p>
            @endforelse
        </div> --}}
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