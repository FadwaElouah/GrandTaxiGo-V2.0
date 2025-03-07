
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --beige-light: #f5f5dc;
            --beige: #e8e4c9;
            --beige-dark: #d6cca9;
            --black: #1a1a1a;
            --black-light: #333333;
        }

        .bg-beige-gradient {
            background-image: linear-gradient(to right, var(--beige-dark), var(--black-light));
        }

        .bg-beige-light {
            background-color: var(--beige-light);
        }

        .bg-beige {
            background-color: var(--beige);
        }

        .bg-beige-dark {
            background-color: var(--beige-dark);
        }

        .bg-black-custom {
            background-color: var(--black);
        }

        .text-beige {
            color: var(--beige);
        }

        .text-beige-dark {
            color: var(--beige-dark);
        }

        .text-black-custom {
            color: var(--black);
        }

        .border-beige {
            border-color: var(--beige);
        }

        .border-beige-dark {
            border-color: var(--beige-dark);
        }

        .hover-bg-black-light:hover {
            background-color: var(--black-light);
        }

        .driver-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-image: linear-gradient(to bottom right, #f8f7f1, #e8e4c9);
            border-color: var(--beige-dark);
        }

        .driver-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
        }

        .focus-beige:focus {
            outline: none;
            --tw-ring-color: var(--beige-dark);
            --tw-ring-opacity: 1;
            --tw-ring-offset-width: 2px;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto p-6">
        <!-- Header Section -->
        <div class="bg-beige-gradient rounded-lg shadow-lg p-8 mb-8 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Welcome, Passenger!</h1>
                    <p class="text-beige">Book your next trip with ease and enjoy a comfortable ride.</p>
                </div>
                <div class="hidden md:block">
                    <i class="fas fa-car text-6xl text-beige opacity-70"></i>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-8">
            <h2 class="text-xl font-semibold mb-4 flex items-center">
                <i class="fas fa-filter text-black-custom mr-2"></i> Find Your Perfect Ride
            </h2>
            <form action="{{ route('filter-drivers') }}" method="GET">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="location" class="block text-gray-700 font-medium mb-2">Location</label>
                        <div class="relative">
                            <select name="location" id="location" class="w-full p-3 border border-gray-300 rounded-lg pl-10 focus-beige focus:ring-2 focus:border-transparent">
                                <option value="">Select Location</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="availability" class="block text-gray-700 font-medium mb-2">Availability</label>
                        <div class="relative">
                            <select name="availability" id="availability" class="w-full p-3 border border-gray-300 rounded-lg pl-10 focus-beige focus:ring-2 focus:border-transparent">
                                <option value="">Select Availability</option>
                                <option value="1">Available</option>
                                <option value="0">Not Available</option>
                            </select>
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-clock text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-black-custom text-beige px-6 py-3 rounded-lg hover-bg-black-light focus:outline-none focus:ring-2 focus:ring-beige-dark focus:ring-opacity-50 transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-search mr-2"></i> Find Drivers
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Drivers Display Section -->
        @if (isset($drivers))
            <div class="bg-white rounded-lg shadow-md p-8">
                <h2 class="text-xl font-semibold mb-6 flex items-center">
                    <i class="fas fa-users text-black-custom mr-2"></i> Available Drivers
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($drivers as $driver)
                        <div class="driver-card border p-6 rounded-lg">
                            <div class="flex items-start">
                                <div class="bg-black-custom rounded-full w-12 h-12 flex items-center justify-center text-beige mr-4">
                                    <i class="fas fa-user text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-black-custom">{{ $driver->name }}</h3>
                                    <div class="flex items-center text-yellow-500 mt-1 mb-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span class="text-gray-600 text-sm ml-1">(4.5)</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 space-y-2">
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-car text-black-custom w-6"></i>
                                    <span>{{ $driver->driverProfile->vehicle_make }} {{ $driver->driverProfile->vehicle_model }}</span>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-map-marker-alt text-black-custom w-6"></i>
                                    <span>{{ $driver->driverProfile->location->name }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-circle w-6 {{ $driver->is_available ? 'text-green-500' : 'text-red-500' }} text-sm"></i>
                                    <span class="{{ $driver->is_available ? 'text-green-600' : 'text-red-600' }} font-medium">
                                        {{ $driver->is_available ? 'Available' : 'Not Available' }}
                                    </span>
                                </div>
                            </div>

                            <a href="{{ route('book-trip') }}?driver_id={{ $driver->id }}" class="mt-6 bg-black-custom text-beige px-4 py-2 rounded-lg hover-bg-black-light transition-colors duration-300 flex items-center justify-center">
                                <i class="fas fa-calendar-check mr-2"></i> Book Now
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</body>
</html>

