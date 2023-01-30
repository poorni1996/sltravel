<?php

namespace App\Http\Controllers;

use App\Models\HotelReviewAndRating;
use Illuminate\Http\Request;

class HotelReviewReportsController extends Controller
{
    /**
     * Display all reports
     */
    public function index()
    {
        $reviews = HotelReviewAndRating::select('hotel_review_and_ratings.*', 'hotels.name as hotel_name', 'users.fname', 'users.lname')
            ->join('hotels', 'hotels.id', 'hotel_review_and_ratings.hotel_id')
            ->join('users', 'users.id', 'hotel_review_and_ratings.user_id_cus')
            ->where('hotel_review_and_ratings.status', "R")
            ->orderBy('hotel_review_and_ratings.created_at', 'desc')
            ->get();
        return view('admin.hotel_review_reports.search', compact('reviews'));
    }

    /**
     * Display the specified report.
     */
    public function show(Request $request)
    {
        $review = HotelReviewAndRating::select('hotel_review_and_ratings.*', 'hotels.name as hotel_name', 'users.fname', 'users.lname')
            ->where('hotel_review_and_ratings.id', $request->id)
            ->join('hotels', 'hotels.id', 'hotel_review_and_ratings.hotel_id')
            ->join('users', 'users.id', 'hotel_review_and_ratings.user_id_cus')
            ->first();
        return view('admin.hotel_review_reports.report', compact('review'));
    }

    /**
     * Remove the specified report from database.
     */
    public function destroy(Request $request)
    {
        $reason = "";
        $status = "K";
        if ($request->action == "R") {
            $reason = $request->removed_reason;
            $status = "D";
        }
        $review = HotelReviewAndRating::find($request->id);
        $review->status = $status;
        $review->removed_reason = $reason;
        $review->user_id_admi = auth()->user()->id;
        $review->save();

        return redirect()->route('hotel_review.report.search')->with('success', 'Review has successfully updated.');
    }
}
