<x-app-layout>
    <div class="container mx-auto p-6">
        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold mb-6">Book a Trip</h1>
            <form action="{{ route('book-trip') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="pickup_location_id" class="block text-gray-700">Pickup Location</label>
                    <select name="pickup_location_id" id="pickup_location_id" class="w-full p-2 border rounded-lg" required>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="destination_location_id" class="block text-gray-700">Destination Location</label>
                    <select name="destination_location_id" id="destination_location_id" class="w-full p-2 border rounded-lg" required>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="scheduled_at" class="block text-gray-700">Scheduled At</label>
                    <input type="datetime-local" name="scheduled_at" id="scheduled_at" class="w-full p-2 border rounded-lg" required>
                </div>

                @if ($driverId)
                    <input type="hidden" name="driver_id" value="{{ $driverId }}">
                @else
                    <div class="mb-4">
                        <label for="driver_id" class="block text-gray-700">Driver</label>

                        {{-- Arabic Version --}}
                        {{-- @if ($drivers->count() > 0)
                            <select name="driver_id" id="driver_id" class="w-full p-2 border rounded-lg">
                                <option value="">Choose a driver</option>
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        @else
                            <p class="text-red-500">No drivers available</p>
                        @endif

                        {{-- English Fallback --}}
                        {{-- @if ($drivers->count() == 0)
                            <p class="text-red-500">No available drivers</p>
                        @endif --}} --}}
                        @if ($drivers->isNotEmpty())
                        <select name="driver_id" id="driver_id" class="w-full p-2 border rounded-lg">
                            <option value="">Choose a driver</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                            @endforeach
                        </select>
                    @else
                        <div class="p-4 bg-yellow-100 text-yellow-700 rounded-lg">
                            🚕 No drivers are available at the moment. Please try again later.
                        </div>
                    @endif


                    </div>
                @endif

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Book Now</button>
            </form>
        </div>
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let pickup = document.getElementById("pickup_location_id");
            let destination = document.getElementById("destination_location_id");

            function checkSameLocation() {
                if (pickup.value === destination.value) {
                    alert("🚫 Pickup location and Destination cannot be the same.");
                    destination.value = "";
                }
            }

            pickup.addEventListener("change", checkSameLocation);
            destination.addEventListener("change", checkSameLocation);
        });
    </script>
</x-app-layout>

