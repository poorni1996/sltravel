<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     */
    public function edit(Request $request)
    {
        $user = auth()->user();
        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Update the specified profile in database.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "fname" => "required|string|max:255",
            "lname" => "required|string|max:255",
            "email" => "required|email",
            "profile_pic" => "image",
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $user = User::find(auth()->user()->id);
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        if ($request->hasFile('profile_pic')) {
            $img_path = $request->profile_pic->store('public/hotel_gallery/' . auth()->user()->id);
            $user->prof_pic = $img_path;
        }
        $user->save();

        return redirect()->route('user_profile.edit')->with('success', 'Profile successfully updated.');
    }
}
