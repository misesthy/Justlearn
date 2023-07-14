<x-app-layout>
    {{-- <x-slot name="header">
        {{ __('Feedbaks') }}
    </x-slot> --}}
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">

    <div class="mb-4 flex justify-between">
        {{-- <a class="rounded-lg border border-transparent bg-purple-600 px-4 py-2 text-center text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-600" href="{{ route('feedbacks.create') }}">
            {{ __('Create') }}
        </a> --}}
    </div>

    <div class="rounded-lg bg-white p-4 shadow-xs">

        <div class="mb-8 w-full overflow-hidden rounded-lg border shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Author</th>
                            <th class="px-4 py-3">Title Ticket</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @forelse($feedbacks as $feedback)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ route('feedbacks.show', $feedback) }}" class="hover:underline">{{ $feedback->title }}</a>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $feedback->user->name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ route('tickets.index', $feedback->id) }}" class="hover:underline">{{ $feedback->ticket->title }}</a>
                                </td>
                                <td class="px-4 py-3 space-x-2">
                                    @hasanyrole('agent')
                                        <a class="rounded-lg border-2 border-transparent bg-purple-600 px-4 py-2 text-center text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-600" href="{{ route('feedbacks.edit', $feedback) }}">
                                            {{ __('Edit') }}
                                        </a>
                                    @endhasanyrole

                                    @role('admin')
                                        <form action="{{ route('feedbacks.destroy', $feedback) }}" method="POST" onsubmit="return confirm('Are you sure?')" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <x-buttons.button>
                                                Delete
                                            </x-buttons.button>
                                        </form>
                                    @endrole
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-4 py-3" colspan="4">No feedbacks found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($feedbacks->hasPages())
                <div class="border-t bg-gray-50 px-4 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 sm:grid-cols-9">
                    {{ $feddbacks->withQueryString()->links() }}
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
</x-app-layout>
