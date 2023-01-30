<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingsController extends Controller
{
    /**
     * Display bookings of user.
     */
    public function index(Request $request)
    {
        $bookings = Booking::select('bookings.*', 'hotels.name as hotel_name')
            ->join('hotels', 'hotels.id', 'bookings.hotel_id')
            ->where('bookings.user_id', auth()->user()->id)
            ->when(!empty($request->name), function ($q) use ($request) {
                $q->where('bookings.name', $request->name);
            })
            ->when(!empty($request->hotel_name), function ($q) use ($request) {
                $q->where('hotels.name', $request->hotel_name);
            })
            ->when(!empty($request->date), function ($q) use ($request) {
                $q->where('bookings.req_date', $request->date);
            })
            ->get();

        return view('admin.hotel_bookings.search', compact('bookings'));
    }
    /**
     * Store the booking details in database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "hotel_id" => "required|int",
            "name" => "required|string|max:255",
            "contact_no" => "required|string|min:10",
            "email" => "required|email",
            "date" => "required|after:now",
            "adults" => "required|int|min:0",
            "children" => "required|int|min:0",
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $book = new Booking();
        $book->hotel_id = $request->hotel_id;
        $book->user_id = auth()->user()->id;
        $book->name = $request->name;
        $book->contact_no = $request->contact_no;
        $book->email = $request->email;
        $book->req_date = $request->date;
        $book->adults = $request->adults;
        $book->children = $request->children;
        $book->save();

        return redirect()->route('hotel_booking.show', ["id" => $book->id])->with('success', 'Hotel has been successfully added to booked hotels list.');
    }

    /**
     * Display the specified booking details.
     */
    public function show(Request $request)
    {
        $booking = Booking::select('bookings.*', 'hotels.name as hotel_name', 'hotels.price as hotel_price', 'hotels.price_child as hotel_child_price')
            ->join('hotels', 'hotels.id', 'bookings.hotel_id')
            ->where('bookings.id', $request->id)
            ->first();

        return view("admin.hotel_bookings.show", compact("booking"));
    }

    /**
     * Display the payment status with specified booking details.
     */
    public function paid(Request $request)
    {
        if ($request->status == "S") {
            $book = Booking::find($request->id);
            $book->status = 'P';
            $book->save();
        }
        $booking = Booking::select('bookings.*', 'hotels.name as hotel_name', 'hotels.price as hotel_price', 'hotels.price_child as hotel_child_price')
            ->join('hotels', 'hotels.id', 'bookings.hotel_id')
            ->where('bookings.id', $request->id)
            ->first();

        return view("admin.hotel_bookings.show", compact("booking"));
    }

    /**
     * Remove the booking details from database.
     */
    public function destroy($id)
    {
        //
    }
}
