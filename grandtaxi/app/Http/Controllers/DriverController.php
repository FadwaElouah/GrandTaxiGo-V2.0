<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Http\Request;

class DriverController extends Controller
{

    // Accepter une réservation
    public function acceptBooking(Booking $booking)
    {
        // Vérifie que le chauffeur est bien assigné à cette réservation
        if ($booking->driver_id !== auth()->id()) {
            return redirect()->back()->with('error', ' Vous n\'êtes pas autorisé à accepter cette réservation.');
        }

        // Met à jour le statut de la réservation
        $booking->update([
            'status' => 'accepted',
        ]);

        return redirect()->back()->with('success', 'Votre réservation a été acceptée avec succès.');
    }

    // Refuser une réservation
    public function rejectBooking(Booking $booking)
    {
        // Vérifie que le chauffeur est bien assigné à cette réservation
        if ($booking->driver_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à refuser cette réservation.');
        }

        // Met à jour le statut de la réservation
        $booking->update([
            'status' => 'declined',
        ]);

        return redirect()->back()->with('success', 'Votre réservation a été rejetée avec succès.');
    }

    // Afficher les demandes de trajet
    // public function tripRequests()
    // {
    //     // Pour le débogage : afficher toutes les réservations en attente
    //     $allPendingBookings = Booking::where('status', 'pending')
    //         ->with(['passenger', 'pickupLocation', 'destinationLocation'])
    //         ->latest()
    //         ->get();

    //     // Afficher les détails complets
    //     dd([
    //         'utilisateur actuel' => auth()->id(),
    //         'nombre de réservations en attente' => $allPendingBookings->count(),
    //         'détails des réservations' => $allPendingBookings->map(function($booking) {
    //             return [
    //                 'id' => $booking->id,
    //                 'driver_id' => $booking->driver_id,
    //                 'passenger_id' => $booking->passenger_id,
    //                 'status' => $booking->status,
    //                 'pickup' => $booking->pickupLocation->name ?? 'N/A',
    //                 'destination' => $booking->destinationLocation->name ?? 'N/A',
    //             ];
    //         })
    //         // ->toArray()
    //     ]);

    //     // Code normal
    //     $tripRequests = Booking::where(function($query) {
    //         $query->where('driver_id', auth()->id())
    //               ->orWhereNull('driver_id'); // إضافة الحجوزات التي لم يتم تعيين سائق لها
    //     })
    //     ->where('status', 'pending')
    //     ->with(['passenger', 'pickupLocation', 'destinationLocation'])
    //     ->latest()
    //     ->get();
    // }

// تعديل طريقة tripRequests
public function tripRequests()
{
    // استرجاع جميع الحجوزات بحالة "pending" والتي تم تعيين السائق الحالي لها
    $tripRequests = Booking::where('driver_id', auth()->id())
        ->where('status', 'pending')
        ->with(['passenger', 'pickupLocation', 'destinationLocation'])
        ->latest()
        ->get();

    return view('driver.trip-requests', compact('tripRequests'));
}

    public function showAvailability()
    {
        // Récupère le statut de disponibilité actuel du chauffeur
        $isAvailable = auth()->user()->is_available;

        return view('driver.availability', compact('isAvailable'));
    }

    // Mettre à jour la disponibilité
    public function updateAvailability(Request $request)
    {
        // Valide la requête
        $request->validate([
            'is_available' => 'required|boolean',
        ]);

        // Met à jour la disponibilité du chauffeur
        auth()->user()->update([
            'is_available' => $request->is_available,
        ]);

        return redirect()->back()->with('success',  'L\'état de disponibilité a été mis à jour avec succès.');
}
}
