<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelAvl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HotelAvailabilityController extends Controller
{
    /**
     * Display a listing of the availability.
     */
    public function search(Request $request)
    {
        $hotel = Hotel::findOrFail($request->hotel_id);
        $avl_items = HotelAvl::where('hotel_id', $request->hotel_id)
            ->when(!empty($request->date), function ($query) use ($request) {
                return $query->where('blocked_date', $request->date);
            })
            ->get();
        $filters = $request->all();
        return view('admin.hotel_availability.search', compact('hotel', 'avl_items', 'filters'));
    }

    /**
     * Show the form for creating a new availability.
     */
    public function create(Request $request)
    {
        $hotel = Hotel::findOrFail($request->hotel_id);
        return view('admin.hotel_availability.create', compact('hotel'));
    }

    /**
     * Store a newly created availability in database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "hotel_id" => "required|int",
            "date" => "required",
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $hotel_avl = new HotelAvl();
        $hotel_avl->hotel_id = $request->hotel_id;
        $hotel_avl->blocked_date = $request->date;
        $hotel_avl->save();

        return redirect()->route('hotel_avl.search', ['hotel_id' => $hotel_avl->hotel_id])->with('success', 'Hotel availability dates successfully updated.');
    }

    /**
     * Remove the specified availability from database.
     */
    public function destroy(Request $request)
    {
        if (Hotel::find($request->hotel_id)->user_id == Auth::user()->id) {
            HotelAvl::find($request->id)->delete();
            return redirect()->route('hotel_avl.search', ['hotel_id' => $request->hotel_id])->with('success', 'Hotel unavailable date successfully removed.');
        }
        return redirect()->route('hotel_avl.search', ['hotel_id' => $request->hotel_id])->with('error', 'Unauthorized!');
    }
}
