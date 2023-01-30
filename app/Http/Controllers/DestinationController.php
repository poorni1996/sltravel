<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\GalleryItem;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DestinationController extends Controller
{
    /**
     * Display a list of the destinations.
     */
    public function index()
    {
        $imageIds = GalleryItem::selectRaw('min(id) id')->groupBy('place_id')->get()->pluck('id');
        $dests = Place::join('gallery_items', function ($q) use ($imageIds) {
            $q->on('gallery_items.place_id', 'places.id');
            $q->whereIn('gallery_items.id', $imageIds);
        })->get();
        return view('pages.destination', compact('dests'));
    }

    /**
     * Search and list the destinations to edit or delete.
     */
    public function search(Request $request)
    {
        $destinations = Place::get();
        return view('admin.destination.search', compact('destinations'));
    }

    /**
     * Show the form for creating a new destination.
     */
    public function create()
    {
        $cities = City::get();
        return view('admin.destination.create', compact('cities'));
    }

    /**
     * Store a newly created destination in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "description" => "required|string",
            "address" => "required|string",
            "city_id" => "required|int",
            "gallery_images" => "required",
            "gallery_images.*" => "required|image",
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $place = new Place();
        $place->name = $request->name;
        $place->description = $request->description;
        $place->address = $request->address;
        $place->city_id = $request->city_id;
        $city = City::find($request->city_id);
        $place->latitude = $city->latitude;
        $place->longitude = $city->longitude;
        $place->user_id = auth()->user()->id;
        $place->save();


        foreach ($request->gallery_images as $k => $gallery_image) {
            $place_gallery = new GalleryItem();
            $place_gallery->place_id = $place->id;
            $img_path = $gallery_image->store('public/place_gallery/' . $place->id);
            $place_gallery->gallery_image = $img_path;
            $place_gallery->save();
        }

        return redirect()->route('destn.edit', ["id" => $place->id])->with('success', 'Your place has been successfully added.');
    }

    /**
     * Display the specified destination.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified destination.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $destn = Place::findOrFail($request->id);
        $cities = City::get();
        return view('admin.destination.edit', compact('cities', 'destn'));
    }

    /**
     * Update the specified destination in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "description" => "required|string",
            "address" => "required|string",
            "city_id" => "required|int",
            "gallery_images.*" => "image",
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $place = Place::findOrFail($request->id);
        $place->name = $request->name;
        $place->description = $request->description;
        $place->address = $request->address;
        $place->city_id = $request->city_id;
        $place->latitude = 0;
        $place->longitude = 0;
        $place->user_id = auth()->user()->id;
        $place->save();


        if (!empty($request->gallery_images)) {
            GalleryItem::where('place_id', $request->id)->delete();
            foreach ($request->gallery_images as $k => $gallery_image) {
                $place_gallery = new GalleryItem();
                $place_gallery->place_id = $place->id;
                $img_path = $gallery_image->store('public/place_gallery/' . $place->id);
                $place_gallery->gallery_image = $img_path;
                $place_gallery->save();
            }
        }

        return redirect()->route('destn.edit', ["id" => $place->id])->with('success', 'Your place has been successfully updated.');
    }

    /**
     * Remove the specified destination from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
