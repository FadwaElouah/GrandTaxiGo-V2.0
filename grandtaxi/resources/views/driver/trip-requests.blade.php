<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        @if ($tripRequests->isNotEmpty())
            <div class="grid gap-4">
                @foreach ($tripRequests as $tripRequest)
                    <div class="p-4 border rounded-lg shadow-md">
                        <div class="space-y-2">
                            <p class="font-semibold text-gray-700">
                                <strong>Passager :</strong> {{ $tripRequest->passenger->name }}
                            </p>
                            <p class="text-gray-600">
                                <strong>Lieu de départ :</strong> {{ $tripRequest->pickupLocation->name }}
                            </p>
                            <p class="text-gray-600">
                                <strong>Destination :</strong> {{ $tripRequest->destinationLocation->name }}
                            </p>
                            <p class="text-gray-500">
                                <strong>Programmé le :</strong> {{ $tripRequest->scheduled_at->format('d/m/Y H:i') }}
                            </p>
                        </div>

                        <div class="mt-4 flex space-x-4">
                            <form action="{{ route('driver.bookings.accept', $tripRequest) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-colors">
                                    Accepter
                                </button>
                            </form>

                            <form action="{{ route('driver.bookings.reject', $tripRequest) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors">
                                    Refuser
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8 text-gray-500">
                <p class="text-xl">Aucune demande de trajet disponible</p>
                <p class="text-sm mt-2">Revenez plus tard ou contactez le support</p>
            </div>
        @endif
    </div>
</x-app-layout>
