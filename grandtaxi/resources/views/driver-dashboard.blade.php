<!-- resources/views/driver-dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Dashboard - GrandTaxiGo</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<!-- Navigation Bar -->
<nav class="bg-blue-600 p-4 text-white">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/" class="text-2xl font-bold">GrandTaxiGo</a>
        <div class="flex items-center space-x-4">
            <a href="/driver-dashboard" class="hover:text-blue-200">Dashboard</a>
            <a href="/profile" class="hover:text-blue-200">Profile</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="hover:text-blue-200">Logout</button>
            </form>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container mx-auto p-6">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-4">Welcome, Driver!</h1>
        <p class="text-gray-700 mb-6">Manage your trips and availability with ease.</p>

        <!-- Example Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Trip Requests -->
            <div class="bg-blue-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold mb-2">Trip Requests</h2>
                <p class="text-gray-600 mb-4">View and accept trip requests from passengers.</p>
                <a href="/trip-requests" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">View Requests</a>
            </div>

            <!-- Trip History -->
            <div class="bg-green-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold mb-2">Trip History</h2>
                <p class="text-gray-600 mb-4">View your completed trips and earnings.</p>
                <a href="/trip-history" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">View History</a>
            </div>

            <!-- Availability -->
            <div class="bg-purple-50 p-6 rounded-lg">
                <h2 class="text-xl font-semibold mb-2">Availability</h2>
                <p class="text-gray-600 mb-4">Update your availability status.</p>
                <a href="/availability" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">Update Availability</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
