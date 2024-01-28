<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ !$note->trashed() ? __('Notes') : __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>{{ session('success') }}</x-alert-success>
            <div class="flex text-gray-900 dark:text-gray-100">
                @if(!$note->trashed())
                    <p class="opacity-70">
                        <strong>Created : </strong> {{ $note->created_at->diffForHumans() }}
                    </p>
                    <p class="opacity-70 ml-4 inline-block">
                        <strong>Updated : </strong> {{ $note->updated_at->diffForHumans() }}
                    </p>
                    <x-primary-button class="ms-3 ml-auto" onclick="window.location='{{ route('notes.edit',$note) }}'">
                        {{ __('Edit Note') }}
                    </x-primary-button>
                    <form action="{{ route('notes.destroy', $note) }}" method="post">
                        @method('delete')
                        @csrf
                        <x-delete-button class="ms-3 ml-auto" onclick="return confirm('Are you sure you wish to move to trash this note?')">
                            {{ __('Move to Trash') }}
                        </x-delete-button>
                    </form>
                @else
                    <p class="opacity-70">
                        <strong>Deleted at : </strong> {{ $note->deleted_at->diffForHumans() }}
                    </p>
                    <form action="{{ route('trashed.update', $note) }}" method="post">
                        @method('put')
                        @csrf
                        <x-primary-button class="ms-3 ml-auto">
                            {{ __('Restore Note') }}
                        </x-primary-button>
                    </form>
                   
                    <form action="{{ route('trashed.destroy', $note) }}" method="post">
                        @method('delete')
                        @csrf
                        <x-delete-button class="ms-3 ml-auto" onclick="return confirm('Are you sure you wish to delete this note forever? This action cannot be undone')">
                            {{ __('Delete Forever') }}
                        </x-delete-button>
                    </form>
                @endif
            </div>
            <div class="mb-6 mt-6 p-6 border-b border-gray-200 shadow-sm sm:rounded-lg bg-black">
                <h2 class="font-bold text-xl text-gray-900 dark:text-gray-100">
                    {{ $note->title }}
                </h2>
                <p class="mt-6 text-gray-900 dark:text-gray-100 whitespace-pre-wrap">{{ $note->text }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
