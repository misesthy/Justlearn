<x-app-layout>
    {{-- <x-slot name="header">
        {{ __('Tickets') }}
    </x-slot> --}}

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Ticket /</span> All Ticket
            </h4>

            <div class="mb-4 flex justify-between">
                @role('agent|user')
                    <a class="btn btn-success" {{-- class="rounded-lg border border-transparent bg-purple-600 px-4 py-2 text-center text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-600"  --}} href="{{ route('tickets.create') }}">
                        {{ __('Create') }}
                    </a>
                @endrole
                {{-- <div class="flex space-x-2">
            <select class="block w-full rounded-md border-gray-300 shadow-sm focus-within:text-primary-600 focus:border-primary-300 focus:ring-primary-200 focus:ring focus:ring-opacity-50" name="status" id="status" onChange="window.location.href=this.value">
                <option value="{{ clearQueryString('status') }}">-- SELECT STATUS --</option>
                @foreach (\App\Models\Status::cases() as $status)
                    <option value="{{ toggle('status', $status->value) }}" @selected($status->value == request('status'))>{{ $status->name }}</option>
                @endforeach
            </select>

            <select class="block w-full rounded-md border-gray-300 shadow-sm focus-within:text-primary-600 focus:border-primary-300 focus:ring-primary-200 focus:ring focus:ring-opacity-50" name="priority" id="priority" onchange="window.location.href=this.value">
                <option value="{{ clearQueryString('priority') }}">-- SELECT PRIORITY --</option>
                @foreach (\App\Models\Priority::cases() as $priority)
                    <option value="{{ toggle('priority', $priority->value) }}" @selected($priority->value == request('priority'))>{{ $priority->name }}</option>
                @endforeach
            </select>

            <select class="block w-full rounded-md border-gray-300 shadow-sm focus-within:text-primary-600 focus:border-primary-300 focus:ring-primary-200 focus:ring focus:ring-opacity-50" name="category" id="category" onchange="window.location.href=this.value">
                <option value="{{ clearQueryString('category') }}">-- SELECT CATEGORY --</option>
                    @foreach (\App\Models\Category::pluck('name', 'id') as $id => $name)
                        <option value="{{ toggle('category', (string) $id) }}" @selected($id == request('category'))>{{ $name }}</option>
                    @endforeach
            </select>
        </div> --}}
            </div>

            <div class="rounded-lg bg-white p-4 shadow-xs">

                <div class="mb-8 w-full overflow-hidden rounded-lg border shadow-xs">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr
                                    class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    <th class="px-4 py-3">Title</th>
                                    <th class="px-4 py-3">Author</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Priority</th>
                                    <th class="px-4 py-3">Categories</th>
                                    {{-- <th class="px-4 py-3">Service</th> --}}
                                    <th class="px-4 py-3">
                                        @role('user')
                                        Services
                                        @endrole

                                        @role('agent')
                                        Assigned to
                                        @endrole

                                        @role('admin')
                                        Assigned to
                                        @endrole
                                    </th>
                                    @role('user')
                                    <th class="px-4 py-3 text-center"></th>
                                    @endrole
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y">
                                @forelse($tickets as $ticket)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3 text-sm">
                                            <a href="{{ route('tickets.show', $ticket) }}"
                                                class="hover:underline">{{ $ticket->title }}</a>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $ticket->user->name }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{  $ticket->status->name }}
                                        </td>

                                        <td class="px-4 py-3 text-sm">
                                            <span
                                                    class="rounded-full bg-gray-50 px-2 py-2" style="background-color: {{ $ticket->priority->color }}; color:white">
                                            {{ $ticket->priority->name }}
                                        </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            @foreach ($ticket->categories as $category)
                                                <span
                                                    class="rounded-full bg-gray-50 px-2 py-2">{{ $category->name }}</span>
                                            @endforeach
                                        </td>
                                        <td class="px-4 py-3 text-sm">

                                            @foreach ($ticket->services as $service)
                                                <span class="rounded-full bg-gray-50 px-2 py-2">
                                                    {{ $service->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td class="px-4 py-3 space-x-2">
                                            @role('agent')
                                            @if ($ticket->user->name != auth()->user()->name)
                                                <a class="rounded-lg border-2 border-transparent bg-purple-600 px-4 py-2 text-center text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-600"
                                                    href="{{ route('tickets.show', $ticket) }}">
                                                    {{ __('Show') }}
                                                </a>
                        
                                                <a class="rounded-lg border-2 border-transparent bg-purple-600 px-4 py-2 text-center text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-600"
                                                href="{{ route('tickets.edit', $ticket) }}">
                                                {{ __('Edit') }}
                                            </a>
                                                @endif
                                                
                                            @endrole
                                            @role('admin')
                                                <form action="{{ route('tickets.destroy', $ticket) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure?')"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-buttons.button>
                                                        Delete
                                                        </x-button.button>
                                                </form>
                                            @endrole
                                        </td>
                                        @role('user')
                                        <td class="px-4 py-3">
                                            <x-links.button-link href="{{ route('feedbacks.showAll', $ticket) }}">Feedbacks</x-links.button-link>
                                        </td>
                                        @endrole

                                        @role('agent')
                                        @if ($ticket->user->name = auth()->user()->name)
                                        <td class="px-4 py-3">
                                            <x-links.button-link href="{{ route('feedbacks.showAll', $ticket) }}">Feedbacks</x-links.button-link>
                                        </td>
                                        @endif
                                        @endrole
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-4 py-3" colspan="4">No tickets found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($tickets->hasPages())
                        <div
                            class="border-t bg-gray-50 px-4 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 sm:grid-cols-9">
                            {{ $tickets->withQueryString()->links() }}
                        </div>
                    @endif
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
 