<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Show the booking form
    public function create(Request $request )
    {
        $locations = Location::all();
        $driverId = $request->query('driver_id');
        // return view('bookings.create', compact('locations', 'driverId'));


        // $drivers = User::where('role', 'driver')
        // ->where('is_available', true)
        // ->get();
        $drivers = User::where('role', 'driver')
        ->where('is_available', 1)
        ->whereNotIn('id', Booking::where('status', 'pending')->pluck('driver_id'))
        ->get();


        return view('bookings.create', [
            'locations' => $locations,
            'driverId' => $driverId,
            'drivers' => $drivers
        ]);

    }

    // Store a new booking
    public function store(Request $request)
    {
        try {
            // Validation des données
            $request->validate([
                'pickup_location_id' => 'required|exists:locations,id',
                'destination_location_id' => 'required|exists:locations,id',
                'scheduled_at' => 'required|date|after:now',
                'driver_id' => 'nullable|exists:users,id',
            ]);

            // Créer la réservation et la stocker dans une variable
            $booking = Booking::create([
                'passenger_id' => Auth::id(),
                'driver_id' => $request->driver_id,
                'pickup_location_id' => $request->pickup_location_id,
                'destination_location_id' => $request->destination_location_id,
                'scheduled_at' => $request->scheduled_at,
                'status' => 'pending',
            ]);

            // Vérification de la réservation créée
            dd('Réservation créée avec succès ', $booking);

            // Ce code ne sera jamais exécuté à cause du dd() précédent
            // return redirect()->route('passenger-dashboard')->with('success', 'Booking created successfully!');
        }
        catch (\Exception $e) {
            dd('Une erreur s\'est produite :' . $e->getMessage());
        }
    }

    // Cancel a booking
    public function cancel(Booking $booking)
    {
        if ($booking->passenger_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if (now()->diffInMinutes($booking->scheduled_at) < 60) {
            return redirect()->back()->with('error', 'You can only cancel a booking at least one hour before departure.');
        }

        $booking->update([
            'status' => 'canceled',
            'canceled_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Booking canceled successfully!');
    }

    // View trip history
    // public function history()
    // {
    //     $bookings = Booking::where('passenger_id', Auth::id())->latest()->get();
    //     return view('bookings.history', compact('bookings'));
    // }

    public function history()
    {
        $user = auth()->user();

        if ($user->role === 'driver') {
            $bookings = Booking::where('driver_id', $user->id)
                ->with(['passenger', 'pickupLocation', 'destinationLocation'])
                ->latest()
                ->get();
        } else {
            $bookings = Booking::where('passenger_id', $user->id)
                ->with(['pickupLocation', 'destinationLocation'])
                ->latest()
                ->get();
        }

        return view('bookings.history', compact('bookings'));
    }


    public function filterDrivers(Request $request)
    {
        $locations = Location::all();

        $query = User::where('role', 'driver');

        // Filtrer par disponibilité si spécifié
        if ($request->availability !== null && $request->availability !== '') {
            $query->where('is_available', $request->availability);
        }

        // Filtrer par localisation si spécifiée
        if ($request->location) {
            $query->whereHas('driverProfile', function ($subquery) use ($request) {
                $subquery->where('location_id', $request->location);
            });
        }

        $drivers = $query->with('driverProfile.location')->get();

        if ($drivers->isEmpty()) {
            return redirect()->back()->with('info', 'Aucun chauffeur trouvé avec les critères sélectionnés.');
        }

        return view('passenger-dashboard', compact('drivers', 'locations'));
    }

    public function confirmBooking(Booking $booking)
{
    if ($booking->driver_id !== Auth::id()) {
        abort(403, 'Unauthorized');
    }

    $booking->update([
        'status' => 'confirmed',
    ]);

    return redirect()->back()->with('success', 'Booking confirmed successfully!');
}





}
