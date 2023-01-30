<?php

namespace App\Http\Controllers;

use App\Models\WishListHotel;
use Illuminate\Http\Request;

class HotelWishListController extends Controller
{
    /**
     * Show the Wishlist.
     */
    public function index()
    {
        $wishlist = WishListHotel::join('hotels', 'hotels.id', 'wish_list_hotels.hotel_id')
            ->where('wish_list_hotels.user_id', auth()->user()->id)
            ->get();
        return view('admin.wishlist.list', compact('wishlist'));
    }

    /**
     * Add the hotel to wishlist.
     */
    public function store(Request $request)
    {
        $wish = new WishListHotel;
        $wish->user_id = auth()->user()->id;
        $wish->hotel_id = $request->hotel_id;
        $wish->save();

        return redirect()->route('hotel', ["id" => $request->hotel_id])->with('success', 'Wishlist successfully updated.');
    }

    /**
     * Remove the hotel from wishlist.
     */
    public function destroy(Request $request)
    {
        WishListHotel::where('user_id', auth()->user()->id)->where('hotel_id', $request->hotel_id)->delete();
        return redirect()->back()->with('success', 'Wishlist successfully updated.');
    }
}
