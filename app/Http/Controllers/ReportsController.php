<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::select('bookings.*', 'hotels.price', 'hotels.name as hotel_name')
            ->join('hotels', 'hotels.id', 'bookings.hotel_id')
            ->when($request->from_date, function ($q) use ($request) {
                $q->whereDate('bookings.updated_at', ">=", $request->from_date);
            })
            ->when($request->to_date, function ($q) use ($request) {
                $q->whereDate('bookings.updated_at', "<=", $request->to_date);
            })
            ->when($request->status, function ($q) use ($request) {
                $q->where('bookings.status', $request->status);
            })
            ->get();
        $filters = $request->all();
        return view('admin.booking_report.result', compact('bookings', 'filters'));
    }
}
