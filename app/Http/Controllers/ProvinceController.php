<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the province.
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $data["srdata"] = Province::where("province_name", "like", "%" . $request->get("province") . "%")->get();
        return view('admin.province.province_search', $data);
    }

    /**
     * Show the form for creating a new province.
     */
    public function create()
    {
        return view('admin.province.province_add',);
    }

    /**
     * Store a newly created resource in databse.
     */
    public function store(Request $request)
    {
        //    dd($request->all());

        $validator = Validator::make($request->all(), [
            "province_name" => ["required", "string"]
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errormsg', 'Something went wrong!')->withErrors($validator)->withInput();
        } else {
            $province = new Province();
            $province->province_name = $request->get("province_name");
            $province->save();
        }
        return redirect()->route('province')->with('successmsg', 'Province Successfully Added');
    }

    /**
     * Display the province.
     */
    public function show($id)
    {
        $data["shdata"] = Province::find($id);
        return view('admin.province.province_show', $data);
    }

    /**
     * Show the form for editing the province.
     */
    public function edit($id)
    {

        $data["shdata"] = Province::find($id);
        return view('admin.province.province_edit', $data);
    }

    /**
     * Update the province in databse.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "province_name" => ["required", "string"]
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errormsg', 'Something went wrong!')->withErrors($validator)->withInput();
        } else {
            $province = Province::find($id);
            $province->province_name = $request->get("province_name");
            $province->save();
            return redirect()->route('province')->with('successmsg', 'Province Successfully Edited');
        }
    }

    /**
     * Remove the province from databse.
     */
    public function destroy($id)
    {
        Province::find($id)->delete();
        return redirect()->route('province')->with('successmsg', 'Province Successfully deleted');
    }
}
