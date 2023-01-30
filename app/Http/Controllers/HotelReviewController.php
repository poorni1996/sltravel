<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelReviewAndRating;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class HotelReviewController extends Controller
{
    /**
     * Display all reviews
     */
    public function index(Request $request)
    {
        $reviews = HotelReviewAndRating::select('hotel_review_and_ratings.*', 'hotels.name as hotel_name', 'users.fname', 'users.lname')
            ->join('hotels', 'hotels.id', 'hotel_review_and_ratings.hotel_id')
            ->join('users', 'users.id', 'hotel_review_and_ratings.user_id_cus')
            ->where('hotels.user_id', auth()->user()->id)
            ->when(!empty($request->name), function($q) use ($request) {
                return $q->whereRaw('CONCAT(users.fname, " ", users.lname) LIKE "%'.$request->name.'%"');
            })
            ->when(!empty($request->status), function($q) use ($request) {
                return $q->where('hotel_review_and_ratings.status', $request->status);
            })
            ->when(!empty($request->hotel_name), function($q) use ($request) {
                return $q->where('hotels.name', 'LIKE', "%".$request->hotel_name."%");
            })
            ->orderBy('hotel_review_and_ratings.created_at', 'desc')
            ->get();
        $filters = $request;
        return view('admin.hotel_reviews.search', compact('reviews', 'filters'));
    }

    /**
     * Store a new review in database
     */
    public function store(Request $request)
    {
        $review = new HotelReviewAndRating();
        $review->review = $request->review;
        $review->ratings = $request->rate;
        $review->status = 'A';
        $review->user_id_cus = auth()->user()->id;
        $review->hotel_id = $request->hotel_id;
        $review->save();
        return redirect()->route('hotel', ["id" => $request->hotel_id])->with('success', 'Your review has successfully saved.');
    }

    /**
     * Show the review details
     */
    public function show(Request $request)
    {
        $review = HotelReviewAndRating::select('hotel_review_and_ratings.*', 'hotels.name as hotel_name', 'users.fname', 'users.lname')
            ->where('hotel_review_and_ratings.id', $request->id)
            ->join('hotels', 'hotels.id', 'hotel_review_and_ratings.hotel_id')
            ->join('users', 'users.id', 'hotel_review_and_ratings.user_id_cus')
            ->first();
        return view('admin.hotel_reviews.report', compact('review'));
    }

    /**
     * Report the review.
     */
    public function report(Request $request)
    {
        $report = HotelReviewAndRating::find($request->id);
        $report->report_reason = $request->report_reason;
        $report->status = 'R';
        $report->user_id_ven = auth()->user()->id;
        $report->save();
        return redirect()->route('hotel_review.search')->with('success', 'Your report has successfully saved.');
    }

    /**
     * Review the specified report.
     */
    public function review($id)
    {
        
    }

    /**
     * Remove the specified review.
     */
    public function destroy($id)
    {
        
    }
}
