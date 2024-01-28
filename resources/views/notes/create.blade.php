<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 mt-6 p-6 border-b border-gray-200 shadow-sm sm:rounded-lg">

                   <form action="{{ route('notes.store') }}" method="post">
                    @csrf
                        <div>
                            <x-text-input 
                            type="text" 
                            name="title" 
                            placeholder="Title" 
                            class="w-full" 
                            autocomplete="off"
                            :value="old('title')"/>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <x-textarea name="text" field="text" rows="10" placeholder="Start typing here..." class="w-full mt-6" autocomplete="off" :value="old('text')"/>

                        <x-primary-button class="mt-6" >
                            {{ __('SAVE NOTE') }}
                        </x-primary-button>
                </form> 
            </div>
        </div>
    </div>
</x-app-layout>
