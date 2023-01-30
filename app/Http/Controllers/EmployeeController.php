<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $data["mydata"] = User::where("user_role", "=", "EMP")
            ->when(!empty($request->empfname), function ($q) use ($request) {
                $q->where("fname", "like", "%" . $request->empfname . "%");
            })
            ->when(!empty($request->emplname), function ($q) use ($request) {
                $q->where("lname", "like", "%" . $request->emplname . "%");
            })
            ->when(!empty($request->empemail), function ($q) use ($request) {
                $q->where("email", "like", "%" . $request->empemail . "%");
            })
            ->get();

        // dd($data)

        return view('admin.employee.employee_search', $data);
    }
    public function create()
    {
        return view('admin.employee.employee_reg');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "f_name" => ["required", "string"],
            "l_name" => ["required", "string"],
            "email" => ["required", "email", "unique:users,email"],
            "password" => ["required", "confirmed"],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errormsg', 'Something went wrong!')->withErrors($validator)->withInput();
        } else {
            $user = new User();
            $user->fname = $request->get("f_name");
            $user->lname = $request->get("l_name");
            $user->email = $request->get("email");
            $user->password = Hash::make($request->get("password"));
            $user->user_role = "EMP";
            $user->status = "A";
            $user->save();
            return redirect()->route('employee')->with('successmsg', 'Employee Successfully Added');
        }
    }
    /**
     * Display the employee.
     */
    public function show($id)
    {
        $data["mydata"] = User::find($id);
        return view('admin.employee.employee_show', $data);
    }

    /**
     * Show the form for editing the employee.
     */
    public function edit($id)
    {
        $data["mydata"] = User::find($id);
        return view('admin.employee.employee_edit', $data);
    }

    /**
     * Update the employee in database.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "f_name" => ["required", "string"],
            "l_name" => ["required", "string"],
            "email" => ["required", "email", "unique:users,email"],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errormsg', 'Something went wrong!')->withErrors($validator)->withInput();
        } else {
            $user = User::find($id);
            $user->fname = $request->get("f_name");
            $user->lname = $request->get("l_name");
            $user->email = $request->get("email");
            $user->save();
            return redirect()->route('employee')->with('successmsg', 'Employee Successfully Edited');
        }
    }

    /**
     * Remove the employee from database.
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('employee')->with('successmsg', 'Employee  Successfully deleted');
    }
}
