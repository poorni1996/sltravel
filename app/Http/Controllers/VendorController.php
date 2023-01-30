<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = User::where('status', 'P')->get();

        return view('admin.vendor.vendor_search', compact('vendors'));


    }
    public function create()
    {
        return view('admin.vendor.vendor_reg');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'required|max:200',
            'l_name' => 'required|max:200',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'br' => 'required|file|mimes:jpeg,png,jpg,pdf|max:3096',
            'phi_report' => 'required|file|mimes:jpeg,png,jpg,pdf|max:3096'
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $vendor = new User();
        $vendor->fname = $request->f_name;
        $vendor->lname = $request->l_name;
        $vendor->email = $request->email;
        $vendor->password = Hash::make($request->password);
        $vendor->status = 'P';
        $vendor->user_role = 'VEN';
        $vendor->save();

        $br_file = $request->br->store('public/vendor_docs/' . $vendor->id);
        $phi_file = $request->phi_report->store('public/vendor_docs/' . $vendor->id);

        $doc = new Document;
        $doc->user_id = $vendor->id;
        $doc->document_type_id = 1;
        $doc->document = $br_file;
        $doc->save();

        $doc = new Document;
        $doc->user_id = $vendor->id;
        $doc->document_type_id = 2;
        $doc->document = $phi_file;
        $doc->save();

        return back()->with('success', 'Your request has been sent successfully. Your account will approved in next 48 hours.');
    }

    public function show(Request $request)
    {
        $vendor = User::find($request->id);
        $doc1 = Document::where('user_id', $request->id)->where('document_type_id', 1)->first();
        $doc2 = Document::where('user_id', $request->id)->where('document_type_id', 2)->first();
        return view('admin.vendor.vendor_app_or_rej', compact('vendor', 'doc1', 'doc2'));
    }

    public function apr_or_rej(Request $request)
    {
        $vendor = User::find($request->id);
        $vendor->status = $request->apr_or_rej;
        $vendor->save();
        return redirect()->route('vendor')->with('success', 'Vendor has been '.($request->apr_or_rej=='A' ? 'approved' : 'rejected').' successfully.');
    }

    public function delete()
    {


        return view('admin.vendor.vendor_reject');
    }



}
