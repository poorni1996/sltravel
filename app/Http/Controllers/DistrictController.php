<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DistrictController extends Controller
{
    /**
     * Display a listing of the district.
     */
    public function index(Request $request)
    {
        $data["province"] = Province::get();
        $data["srcdata"] = DB::table("districts")
            ->join("provinces", "provinces.id", "districts.province_id")
            ->where("districts.district_name", "like", "%" . $request->get("district") . "%")
            ->when(!empty($request->get("province_id")), function ($q) use ($request) {
                $q->where("provinces.id", "=",  $request->get("province_id"));
            })
            ->select(["districts.id", "districts.district_name", "provinces.province_name"])
            ->get();
        return view("admin.district.district_search", $data);
    }

    /**
     * Show the form for creating a new district.
     */
    public function create()
    {
        $data["province"] = Province::get();
        return view("admin.district.district_add", $data);
    }

    /**
     * Store a newly created district in database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "description" => ["required", "string", "max:50"],
            "province_id" => ["required"],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errormsg', 'Something went wrong!')->withErrors($validator)->withInput();
        } else {
            $dis = new District();
            $dis->district_name = $request->get("description");
            $dis->province_id = $request->get("province_id");
            $dis->save();
            return redirect()->route('district')->with('successmsg', 'Province Successfully Edited');
        }
    }

    /**
     * Display the specified district.
     */
    public function show($id)
    {
        $data["province"] = Province::get();
        $data["shdata"] = District::find($id);
        return view('admin.district.district_show', $data);
    }

    /**
     * Show the form for editing the specified district.
     */
    public function edit($id)
    {
        $data["province"] = Province::get();
        $data["shdata"] = District::find($id);
        return view('admin.district.district_edit', $data);
    }

    /**
     * Update the specified district in database.
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
     * Remove the specified district from database.
     */
    public function destroy($id)
    {
        District::find($id)->delete();
        return redirect()->route('district')->with('successmsg', 'District  Successfully deleted');
    }
}
