<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold mb-6">Trip History</h1>
            <div class="space-y-4">
                @foreach ($bookings as $booking)
                    <div class="p-4 border rounded-lg">
                        <p><strong>Pickup:</strong> {{ $booking->pickupLocation->name }}</p>
                        <p><strong>Destination:</strong> {{ $booking->destinationLocation->name }}</p>
                        <p><strong>Scheduled At:</strong> {{ $booking->scheduled_at->format('Y-m-d H:i') }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
                        @if ($booking->status === 'pending')
                            <form action="{{ route('cancel-booking', $booking) }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Cancel Booking</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
