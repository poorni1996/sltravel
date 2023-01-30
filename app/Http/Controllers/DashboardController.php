<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings_count = Booking::when(auth()->user()->user_role == 'CUS', function ($q) {
            $q->where('user_id', auth()->user()->id);
        })->when(auth()->user()->user_role == 'VEN', function ($q) {
            $q->join('hotels', 'bookings.hotel_id', 'hotels.id')->where('hotels.user_id', auth()->user()->id);
        })->count();
        $payments_count = Booking::when(auth()->user()->user_role == 'CUS', function ($q) {
            $q->where('user_id', auth()->user()->id);
        })->when(auth()->user()->user_role == 'VEN', function ($q) {
            $q->join('hotels', 'bookings.hotel_id', 'hotels.id')->where('hotels.user_id', auth()->user()->id);
        })->where('status', 'P')->count();
        $user_count = 0;
        $hotels_count = 0;
        if (auth()->user()->user_role == 'ADMIN') {
            $user_count = User::whereNotIn('user_role', ['ADMIN', 'EMP'])->count();
        }
        if (auth()->user()->user_role != 'USR') {
            $hotels_count = Hotel::when(auth()->user()->user_role == 'VEN', function ($q) {
                $q->where('user_id', auth()->user()->id);
            })->count();
        }
        return view('admin.dashboard', compact('bookings_count', 'payments_count', 'user_count', 'hotels_count'));
    }
}
