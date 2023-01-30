<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelMenuItem;
use App\Models\MenuGalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelMenuController extends Controller
{
    /**
     * Display a listing of the menu.
     */
    public function index(Request $request)
    {
        $mnu_img_ids = MenuGalleryItem::selectRaw('min(id) id')->groupBy('menu_item_id')->get()->pluck('id');
        $menu = HotelMenuItem::join('menu_gallery_items', function ($q) use ($mnu_img_ids) {
            $q->on('menu_gallery_items.menu_item_id', 'hotel_menu_items.id');
            $q->whereIn('menu_gallery_items.id', $mnu_img_ids);
        })
            ->get();
        return view('pages.menu', compact('menu'));
    }

    /**
     * Search and list the menu items in hotel to edit or delete.
     */
    public function search(Request $request)
    {
        $hotel = Hotel::findOrFail($request->hotel_id);
        $menu_items = HotelMenuItem::where('hotel_id', $request->hotel_id)
            ->get();
        return view('admin.hotel_menu.search', compact('hotel', 'menu_items'));
    }

    /**
     * Show the form for creating a new menu.
     */
    public function create(Request $request)
    {
        $hotel = Hotel::findOrFail($request->hotel_id);
        return view('admin.hotel_menu.create', compact('hotel'));
    }

    /**
     * Store a newly created menu in database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "description" => "required|string",
            "gallery_images" => "required",
            "gallery_images.*" => "required|image",
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $menu_item = new HotelMenuItem();
        $menu_item->hotel_id = $request->hotel_id;
        $menu_item->name = $request->name;
        $menu_item->description = $request->description;
        $menu_item->save();


        foreach ($request->gallery_images as $k => $gallery_image) {
            $menu_gallery = new MenuGalleryItem();
            $menu_gallery->menu_item_id = $menu_item->id;
            $img_path = $gallery_image->store('public/menu_gallery/' . $request->hotel_id);
            $menu_gallery->image = $img_path;
            $menu_gallery->save();
        }

        return redirect()->route('hotel_menu.search', ["hotel_id" => $request->hotel_id])->with('success', 'Your hotel menu item has been successfully added.');
    }

    /**
     * Display the specified menu.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified menu.
     */
    public function edit(Request $request)
    {
        $hotel = Hotel::findOrFail($request->hotel_id);
        $menu_item = HotelMenuItem::where('hotel_id', $request->hotel_id)
            ->where('id', $request->id)
            ->firstOrFail();
        return view('admin.hotel_menu.edit', compact('hotel', 'menu_item'));
    }

    /**
     * Update the specified menu in database.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "description" => "required|string",
            "gallery_images.*" => "image",
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $menu_item = HotelMenuItem::where('hotel_id', $request->hotel_id)->where('id', $request->menu_item_id)->first();
        $menu_item->name = $request->name;
        $menu_item->description = $request->description;
        $menu_item->save();



        if (!empty($request->gallery_images)) {
            MenuGalleryItem::where('menu_item_id', $request->menu_item_id)->delete();
            foreach ($request->gallery_images as $k => $gallery_image) {
                $menu_gallery = new MenuGalleryItem();
                $menu_gallery->menu_item_id = $menu_item->id;
                $img_path = $gallery_image->store('public/menu_gallery/' . $request->hotel_id);
                $menu_gallery->image = $img_path;
                $menu_gallery->save();
            }
        }

        return redirect()->route('hotel_menu.search', ["hotel_id" => $request->hotel_id])->with('success', 'Your hotel menu item has been successfully updated.');
    }

    /**
     * Remove the specified menu from database.
     */
    public function destroy($id)
    {
        //
    }
}
