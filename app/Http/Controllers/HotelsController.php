<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityGalleryItem;
use App\Models\Booking;
use App\Models\City;
use App\Models\FeaturesOfHotel;
use App\Models\Hotel;
use App\Models\HotelActivity;
use App\Models\HotelAvl;
use App\Models\HotelFeature;
use App\Models\HotelGalleryItem;
use App\Models\HotelMenuItem;
use App\Models\HotelReviewAndRating;
use App\Models\HotelTelephone;
use App\Models\MenuGalleryItem;
use App\Models\WishListHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HotelsController extends Controller
{
    /**
     * Display a listing of the hotels.
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "q" => "sometimes|nullable|string",
            "city" => "sometimes|nullable|int",
            "activity" => "sometimes|nullable|string",
            "menu" => "sometimes|nullable|string",
            "date" => "sometimes|nullable",
            "price_from" => "sometimes|nullable|numeric|min:0",
            "price_to" => "sometimes|nullable|numeric|min:0",
        ]);

        if ($validator->fails()) {
            return redirect()->route('public_hotels')->withInput()->withErrors($validator);
        }

        $imageIds = HotelGalleryItem::selectRaw('min(id)')->groupBy('hotel_id')->get();

        $hotels = Hotel::select('*', 'hotels.id as id')
            ->join('cities', 'hotels.city_id', 'cities.id')
            ->join('hotel_gallery_items', function ($q) use ($imageIds) {
                $q->on('hotel_gallery_items.hotel_id', 'hotels.id');
                $q->whereIn('hotel_gallery_items.id', $imageIds);
            })
            ->when(!empty($request->q), function ($query) use ($request) {
                return $query->whereRaw('CONCAT(hotels.name, hotels.description) LIKE "%' . $request->q . '%"');
            })
            ->when(!empty($request->destination), function ($query) use ($request) {
                return $query->where('hotels.city_id', $request->destination);
            })
            ->when(!empty($request->city), function ($query) use ($request) {
                $city = City::find($request->city);
                return $query->selectRaw('(
                    6371
                    * acos(
                        cos( radians(' . $city->latitude . ') ) 
                        * cos( radians( hotels.latitude ) ) 
                        * cos( radians( hotels.longitude ) - radians(' . $city->longitude . ') ) 
                        + sin( radians( ' . $city->latitude . ' ) ) 
                        * sin( radians( hotels.latitude ) ) 
                    ) 
                ) as distance')
                    ->orderBy('distance');
            })
            ->when(!empty($request->activity), function ($query) use ($request) {
                $hotels_4_act = Activity::select('hotel_activities.hotel_id')
                    ->join('hotel_activities', 'activities.id', 'hotel_activities.activity_id')
                    ->whereRaw('CONCAT(activities.title, activities.description) LIKE "%' . $request->activity . '%"')
                    ->get();
                return $query->whereIn('hotels.id', $hotels_4_act);
            })
            ->when(!empty($request->menu), function ($query) use ($request) {
                $hotels_4_menu = HotelMenuItem::select('hotel_id')
                    ->whereRaw('CONCAT(name, description) LIKE "%' . $request->menu . '%"')
                    ->get();
                return $query->whereIn('hotels.id', $hotels_4_menu);
            })
            ->when(!empty($request->date), function ($query) use ($request) {
                $unavailable_hotels = HotelAvl::where('blocked_date', $request->date)->get()->pluck('hotel_id');
                return $query->whereNotIn('hotels.id', $unavailable_hotels);
            })
            ->when(!empty($request->price_from), function ($query) use ($request) {
                return $query->where('hotels.price', '>=', $request->price_from);
            })
            ->when(!empty($request->price_to), function ($query) use ($request) {
                return $query->where('hotels.price', '<=', $request->price_to);
            })
            ->get();
        $cities = City::get();
        $filters = $request;
        return view('pages.hotels', compact('hotels', 'cities', 'filters'));
    }
    /**
     * Search and list the hotels to edit or delete.
     */
    public function search(Request $request)
    {
        $hotels = Hotel::where('user_id', auth()->user()->id)
            ->when(!empty($request->name), function ($q) use ($request) {
                return $q->where('hotels.name', 'LIKE', "%" . $request->name . "%");
            })
            ->when(!empty($request->description), function ($q) use ($request) {
                return $q->where('hotels.description', 'LIKE', "%" . $request->description . "%");
            })
            ->get();
        $filters = $request;
        return view('admin.hotels.search', compact('hotels', 'filters'));
    }

    /**
     * Show the form for creating a new hotel.
     */
    public function create()
    {
        $hotel_features = HotelFeature::get();
        $cities = City::get();
        return view('admin.hotels.create', compact('cities', "hotel_features"));
    }

    /**
     * Store a newly created hotel in database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "description" => "required|string",
            "price" => "required|numeric|min:0",
            "price_child" => "required|numeric|min:0",
            "address" => "required|string",
            "city_id" => "required|int",
            "telephone" => "required|string|min:10",
            "feature" => "required",
            "gallery_images" => "required",
            "gallery_images.*" => "required|image",
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $hotel = new Hotel();
        $hotel->name = $request->name;
        $hotel->description = $request->description;
        $hotel->price = $request->price;
        $hotel->price_child = $request->price_child;
        $hotel->address = $request->address;
        $hotel->city_id = $request->city_id;
        $hotel->latitude = $request->latitude;
        $hotel->longitude = $request->longitude;
        $hotel->user_id = auth()->user()->id;
        $hotel->save();

        $hotel_tel = new HotelTelephone();
        $hotel_tel->hotel_id = $hotel->id;
        $hotel_tel->telephone = $request->telephone;
        $hotel_tel->save();

        foreach ($request->feature as $feature => $v) {
            $hotel_feature = new FeaturesOfHotel();
            $hotel_feature->hotel_id = $hotel->id;
            $hotel_feature->hotel_feature_id = $feature;
            $hotel_feature->save();
        }

        foreach ($request->gallery_images as $k => $gallery_image) {
            $hotel_gallery = new HotelGalleryItem();
            $hotel_gallery->hotel_id = $hotel->id;
            $img_path = $gallery_image->store('public/hotel_gallery/' . $hotel->id);
            $hotel_gallery->image = $img_path;
            $hotel_gallery->save();
        }

        return redirect()->route('hotels.edit', ["id" => $hotel->id])->with('success', 'Your hotel has been successfully added.');
    }

    /**
     * Display the specified hotel.
     */
    public function show(Request $request)
    {
        $hotel = Hotel::when(!empty($request->from), function ($query) use ($request) {
            $city = City::find($request->from);
            return $query->selectRaw('*, (
                6371
                * acos(
                    cos( radians(' . $city->latitude . ') ) 
                    * cos( radians( hotels.latitude ) ) 
                    * cos( radians( hotels.longitude ) - radians(' . $city->longitude . ') ) 
                    + sin( radians( ' . $city->latitude . ' ) ) 
                    * sin( radians( hotels.latitude ) ) 
                ) 
            ) as distance');
        })
            ->findOrFail($request->id);
        $images = HotelGalleryItem::where('hotel_id', $request->id)->get();
        $features = FeaturesOfHotel::where('hotel_id', $request->id)->join('hotel_features', 'hotel_features.id', 'features_of_hotels.hotel_feature_id')->get();
        $telephones = HotelTelephone::where('hotel_id', $request->id)->get();
        $act_ids = HotelActivity::where('hotel_id', $request->id)->get()->pluck('activity_id');
        $act_img_ids = ActivityGalleryItem::selectRaw('min(id) id')->whereIn('activity_id', $act_ids)->groupBy('activity_id')->get()->pluck('id');
        $activities = Activity::join('activity_gallery_items', function ($q) use ($act_img_ids) {
            $q->on('activity_gallery_items.activity_id', 'activities.id');
            $q->whereIn('activity_gallery_items.id', $act_img_ids);
        })
            ->whereIn('activities.id', $act_ids)
            ->get();
        $mnu_img_ids = MenuGalleryItem::selectRaw('min(id) id')->groupBy('menu_item_id')->get()->pluck('id');
        $menu = HotelMenuItem::where('hotel_id', $request->id)
            ->join('menu_gallery_items', function ($q) use ($mnu_img_ids) {
                $q->on('menu_gallery_items.menu_item_id', 'hotel_menu_items.id');
                $q->whereIn('menu_gallery_items.id', $mnu_img_ids);
            })
            ->get();
        $wishlist = null;
        $can_review = false;
        if (Auth::check()) {
            $wishlist = WishListHotel::where('user_id', auth()->user()->id)->where('hotel_id', $hotel->id)->first();
            $bookings = Booking::where('user_id', auth()->user()->id)->where('status', 'P')->where('hotel_id', $hotel->id)->get();
            $can_review = !$bookings->isEmpty();
        }
        $reviews = HotelReviewAndRating::where('hotel_id', $hotel->id)->whereIn('hotel_review_and_ratings.status', ['A', 'K'])->join('users', 'users.id', 'hotel_review_and_ratings.user_id_cus')->get();
        $sumRate = HotelReviewAndRating::where('hotel_id', $hotel->id)->whereIn('status', ['A', 'K'])->sum('ratings');
        $rateCount = HotelReviewAndRating::where('hotel_id', $hotel->id)->whereIn('status', ['A', 'K'])->count('id');
        $total_rate = $rateCount != 0 ?  $sumRate / $rateCount : 0;
        return view('pages.hotel', compact('hotel', 'images', 'features', 'telephones', 'activities', 'menu', 'wishlist', 'reviews', 'total_rate', 'can_review'));
    }

    /**
     * Show the form for editing the specified hotel.
     */
    public function edit(Request $request)
    {
        $hotel = Hotel::findOrFail($request->id);
        // $image = HotelGalleryItem::where('hotel_id', $request->id)->first();
        $features = FeaturesOfHotel::where('hotel_id', $request->id)->join('hotel_features', 'hotel_features.id', 'features_of_hotels.hotel_feature_id')->get()->pluck('hotel_feature_id')->toArray();
        $telephones = HotelTelephone::where('hotel_id', $request->id)->first();
        $hotel_features = HotelFeature::get();
        $cities = City::get();

        return view('admin.hotels.edit', compact('hotel', 'features', 'telephones', 'cities', "hotel_features"));
    }

    /**
     * Update the specified hotel in database.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "description" => "required|string",
            "price" => "required|numeric|min:0",
            "price_child" => "required|numeric|min:0",
            "address" => "required|string",
            "city_id" => "required|int",
            "telephone" => "required|string|min:10",
            "feature" => "required",
            "gallery_images.*" => "image",
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $hotel = Hotel::findOrFail($request->id);
        $hotel->name = $request->name;
        $hotel->description = $request->description;
        $hotel->price = $request->price;
        $hotel->price_child = $request->price_child;
        $hotel->address = $request->address;
        $hotel->city_id = $request->city_id;
        $hotel->latitude = $request->latitude;
        $hotel->longitude = $request->longitude;
        $hotel->user_id = auth()->user()->id;
        $hotel->save();

        $hotel_tel = HotelTelephone::where('hotel_id', $request->id)->first();
        $hotel_tel->telephone = $request->telephone;
        $hotel_tel->save();

        FeaturesOfHotel::where('hotel_id', $request->id)->delete();
        foreach ($request->feature as $feature => $v) {
            $hotel_feature = new FeaturesOfHotel();
            $hotel_feature->hotel_id = $hotel->id;
            $hotel_feature->hotel_feature_id = $feature;
            $hotel_feature->save();
        }
        if (!empty($request->gallery_images)) {
            HotelGalleryItem::where('hotel_id', $request->id)->delete();
            foreach ($request->gallery_images as $k => $gallery_image) {
                $hotel_gallery = new HotelGalleryItem();
                $hotel_gallery->hotel_id = $hotel->id;
                $img_path = $gallery_image->store('public/hotel_gallery/' . $hotel->id);
                $hotel_gallery->image = $img_path;
                $hotel_gallery->save();
            }
        }

        return redirect()->route('hotels.edit', ["id" => $hotel->id])->with('success', 'Your hotel has been successfully updated.');
    }

    /**
     * Remove the specified hotel from database.
     */
    public function destroy($id)
    {
        //
    }
}
