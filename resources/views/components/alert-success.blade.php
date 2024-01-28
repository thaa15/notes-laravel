@if(session('success'))
    <div class="mb-4 px-4 py-2 bg-gray-100 border border-green-200 text-gray-700 rounded-md">
        {{ $slot }}
    </div>
@endif