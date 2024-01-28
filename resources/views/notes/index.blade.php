<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ request()->routeIs('notes.index') ? __('Notes') : __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>{{ session('success') }}</x-alert-success>
            {{-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("All Notes") }}
                </div>
            </div> --}}
            @if(request()->routeIs('notes.index'))
                <x-primary-button class="ms-3" onclick="window.location='{{ route('notes.create') }}'">
                    {{ __('+ New Note') }}
                </x-primary-button>
            @endif
            @forelse ($notes as $note)
                <div class="mb-6 mt-6 p-6 border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-xl text-gray-900 dark:text-gray-100">
                        <a
                            @if(request()->routeIs('notes.index'))
                            href="{{ route('notes.show', $note) }}"
                            @else
                            href="{{ route('trashed.show', $note) }}"
                            @endif
                        >
                            {{ $note->title }}
                        </a>
                    </h2>
                    <p class="mt-2 text-gray-900 dark:text-gray-100">{{ Str::limit($note->text,200) }}</p>
                    <span class="text-gray-900 dark:text-gray-100 block mt-4 text-sm opacity-70">{{ $note->updated_at->diffForHumans() }}
                </div>
            @empty
            @if(request()->routeIs('notes.index'))
                <p class="mt-2 text-gray-900 dark:text-gray-100">You have no notes yet.</p>
            @else
                <p class="mt-2 text-gray-900 dark:text-gray-100">No Item in This Trash</p>
            @endif
            @endforelse

            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>
