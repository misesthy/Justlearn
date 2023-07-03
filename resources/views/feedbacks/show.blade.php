<x-app-layout>
    <x-slot name="header">
        {{ $feedback->title }}
    </x-slot>

    @hasanyrole('admin|agent')
        <div class="mb-4 flex justify-end">
            @if($feedback->isOpen())
                <form action="{{ route('feedback.close', $feedback) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('PATCH')
                    <x-primary-button>
                        Close
                    </x-primary-button>
                </form>
            @elseif(!$feedback->isArchived())
                <form action="{{ route('feedback.reopen', $feedback) }}" method="POST" class="mr-2" style="display: inline-block;">
                    @csrf
                    @method('PATCH')
                    <x-primary-button>
                        Reopen
                    </x-primary-button>
                </form>

                <form action="{{ route('feedback.archive', $feedback) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('PATCH')
                    <x-primary-button>
                        Archive
                    </x-primary-button>
                </form>
            @endif
        </div>
    @endhasanyrole

    <div class="space-y-4">
        <div class="min-w-0 rounded-lg bg-white p-4 shadow-xs">
            <p class="text-gray-600">
                {{ $feedback->message }}
            </p>
        </div>

        @if($feedback->getMedia('feedback_attachments')->count())
            <div class="min-w-0 rounded-lg bg-white p-4 shadow-xs">
                <h4 class="mb-4 font-semibold text-gray-600">
                    Attachments
                </h4>

                @foreach($feedback->getMedia('feedback_attachments') as $media)
                    <p>
                        <a href="{{ route('attachment-download', $media) }}" class="hover:underline">{{ $media->file_name }}</a>
                    </p>
                @endforeach
            </div>
        @endif

        <div class="min-w-0 rounded-lg bg-white p-4 shadow-xs space-y-4">
            <h4 class="mb-4 font-semibold text-gray-600">
                Messages
            </h4>

            @if(!$feedback->isArchived())
                <form action="{{ route('message.store', $feedback) }}" method="POST">
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

            @forelse($feedback->messages as $message)
                <p class="rounded-lg bg-gray-50 p-3">{{ $message->message }}</p>
            @empty
                <p class="text-gray-600">
                    No messages found.
                </p>
            @endforelse
        </div>
    </div>
</x-app-layout>