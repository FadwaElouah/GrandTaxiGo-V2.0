<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold mb-6">Update Availability</h1>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('driver.update-availability') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">Availability Status</label>
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="is_available" value="1" class="form-radio" {{ auth()->user()->is_available ? 'checked' : '' }}>
                            <span class="ml-2">Available</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" name="is_available" value="0" class="form-radio" {{ !auth()->user()->is_available ? 'checked' : '' }}>
                            <span class="ml-2">Not Available</span>
                        </label>
                    </div>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Update Availability
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
