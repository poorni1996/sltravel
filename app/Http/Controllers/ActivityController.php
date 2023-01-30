<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityGalleryItem;
use App\Models\Hotel;
use App\Models\HotelActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActivityController extends Controller
{
    /**
     * Display a listing of the activity.
     */
    public function index()
    {
        $act_img_ids = ActivityGalleryItem::selectRaw('min(id) id')->groupBy('activity_id')->get()->pluck('id');
        $activities = Activity::join('activity_gallery_items', function ($q) use ($act_img_ids) {
            $q->on('activity_gallery_items.activity_id', 'activities.id');
            $q->whereIn('activity_gallery_items.id', $act_img_ids);
        })
            ->get();
        return view('pages.activity', compact('activities'));
    }

    /**
     * Search and list the activities in hotel to edit or delete.
     */
    public function search(Request $request)
    {
        $hotel = Hotel::findOrFail($request->hotel_id);
        $hotel_act_tbl = (new HotelActivity)->getTable();
        $activities = Activity::select((new Activity)->getTable() . ".*", $hotel_act_tbl . '.hotel_id')->join($hotel_act_tbl, $hotel_act_tbl . '.activity_id', (new Activity)->getTable() . '.id')
            ->where($hotel_act_tbl . '.hotel_id', $request->hotel_id)
            ->get();
        return view('admin.hotel_acts.search', compact('hotel', 'activities'));
    }

    /**
     * Show the form for creating a new activity for hotel.
     */
    public function create(Request $request)
    {
        $hotel = Hotel::findOrFail($request->hotel_id);
        // $hotel_act_tbl = (new HotelActivity)->getTable();
        return view('admin.hotel_acts.create', compact('hotel'));
    }

    /**
     * Store a newly created activity in database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|string|max:255",
            "description" => "required|string",
            "gallery_images" => "required",
            "gallery_images.*" => "required|image",
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $activity = new Activity();
        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->save();

        $hotel_act = new HotelActivity();
        $hotel_act->hotel_id = $request->hotel_id;
        $hotel_act->activity_id = $activity->id;
        $hotel_act->save();

        foreach ($request->gallery_images as $k => $gallery_image) {
            $activity_gallery = new ActivityGalleryItem();
            $activity_gallery->activity_id = $activity->id;
            $img_path = $gallery_image->store('public/activity_gallery/' . $request->hotel_id);
            $activity_gallery->image = $img_path;
            $activity_gallery->save();
        }

        return redirect()->route('hotel_acts.search', ["hotel_id" => $request->hotel_id])->with('success', 'Your hotel activity has been successfully added.');
    }

    /**
     * Display the specified activity.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified activity.
     */
    public function edit(Request $request)
    {
        $hotel = Hotel::findOrFail($request->hotel_id);
        $hotel_act_tbl = (new HotelActivity)->getTable();
        $activity = Activity::select((new Activity)->getTable() . ".*", $hotel_act_tbl . '.hotel_id')
            ->join($hotel_act_tbl, $hotel_act_tbl . '.activity_id', (new Activity)->getTable() . '.id')
            ->where($hotel_act_tbl . '.hotel_id', $request->hotel_id)
            ->where((new Activity)->getTable() . '.id', $request->id)
            ->first();
        return view('admin.hotel_acts.edit', compact('hotel', 'activity'));
    }

    /**
     * Update the specified activity in database.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|string|max:255",
            "description" => "required|string",
            "gallery_images.*" => "image",
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $activity = Activity::findOrFail($request->activity_id);
        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->save();

        if (!empty($request->gallery_images)) {
            ActivityGalleryItem::where('activity_id', $request->activity_id)->delete();
            foreach ($request->gallery_images as $k => $gallery_image) {
                $activity_gallery = new ActivityGalleryItem();
                $activity_gallery->activity_id = $activity->id;
                $img_path = $gallery_image->store('public/activity_gallery/' . $request->hotel_id);
                $activity_gallery->image = $img_path;
                $activity_gallery->save();
            }
        }

        return redirect()->route('hotel_acts.search', ["hotel_id" => $request->hotel_id])->with('success', 'Your hotel activity has been successfully updated.');
    }

    /**
     * Remove the specified activity from database.
     */
    public function destroy($id)
    {
        //
    }
}
