<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the contact request.
     */
    public function index()
    {
        $contactRequests = ContactRequest::orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.contact.search', compact('contactRequests'));
    }

    /**
     * Show the form for creating a new contact request.
     */
    public function create()
    {
        return view('pages.contact');
    }

    /**
     * Store a newly created contact request in database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'person_type' => 'required|in:H,C',
            'f_name' => 'required|max:200',
            'l_name' => 'required|max:200',
            'email' => 'required|email',
            'message' => 'required|string'
        ], [
            'person_type.required' => 'This field is required'
        ], [
            'f_name' => 'First Name',
            'l_name' => 'Last Name',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $contact = new ContactRequest();
        $contact->person_type = $request->person_type;
        $contact->f_name = $request->f_name;
        $contact->l_name = $request->l_name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();
        return back()->with('success', 'Your message has been sent successfully.');
    }

    /**
     * Display the specified contact request.
     */
    public function show(Request $request)
    {
        // if find the data, get the contact request, else show 404 Not Found page.
        $contactRequest = ContactRequest::findOrFail($request->id);

        return view('admin.contact.view', compact('contactRequest'));
    }
}
