<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    /**
     * Display a listing of the city.
     */
    public function index(Request $request)
    {
        $data["districts"] = District::get();
        $data["srcdata"] = DB::table("cities")
            ->join("districts", "districts.id", "cities.district_id")
            ->where("cities.city_name", "like", "%" . $request->get("city") . "%")
            ->when(!empty($request->get("district_id")), function ($q) use ($request) {
                $q->where("districts.id", "=",  $request->get("district_id"));
            })
            ->when(empty($request->get("district_id")) && empty($request->get("city")), function ($q) use ($request) {
                $q->where("districts.id", "=",  '1');
            })
            ->select(["cities.id", "cities.city_name", "districts.district_name"])
            ->get();
        return view("admin.city.city_search", $data);
    }

    /**
     * Show the form for creating a new city.
     */
    public function create()
    {
        $data["districts"] = District::get();
        return view("admin.city.city_add", $data);
    }

    /**
     * Store a newly created city in database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "description" => ["required", "string", "max:50"],
            "district_id" => ["required"],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errormsg', 'Something went wrong!')->withErrors($validator)->withInput();
        } else {
            $dis = new City();
            $dis->city_name = $request->get("description");
            $dis->district_id = $request->get("district_id");
            $dis->longitude = 0;
            $dis->latitude = 0;
            $dis->save();
            return redirect()->route('city')->with('successmsg', 'City Successfully Created');
        }
    }

    /**
     * Return the closest city.
     */
    public function closest(Request $request)
    {
        $city = City::select('*', DB::raw('(
            6371
            * acos(
                cos( radians('.$request->get('lat', '').') ) 
                * cos( radians( latitude ) ) 
                * cos( radians( longitude ) - radians('.$request->get('lng', '').') ) 
                + sin( radians( '.$request->get('lat', '').' ) ) 
                * sin( radians( latitude ) ) 
            ) 
        ) AS distance'))
        ->orderBy('distance', 'asc')
        ->first();

        return response()->json($city);
    }

    /**
     * Display the specified city.
     */
    public function show($id)
    {
        $data["districts"] = District::get();
        $data["shdata"] = City::find($id);
        return view('admin.city.city_show', $data);
    }

    /**
     * Show the form for editing the specified city.
     */
    public function edit($id)
    {
        $data["districts"] = District::get();
        $data["shdata"] = City::find($id);
        return view('admin.city.city_edit', $data);
    }

    /**
     * Update the specified city in database.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "district_name" => ["required", "string"]
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errormsg', 'Something went wrong!')->withErrors($validator)->withInput();
        } else {
            $district = District::find($id);
            $district->province_name = $request->get("district_name");
            $district->save();
            return redirect()->route('district')->with('successmsg', 'District Successfully Edited');
        }
    }

    /**
     * Remove the specified city from database.
     */
    public function destroy($id)
    {
        District::find($id)->delete();
        return redirect()->route('district')->with('successmsg', 'District  Successfully deleted');
    }
}
