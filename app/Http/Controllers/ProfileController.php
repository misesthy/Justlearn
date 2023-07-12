<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use Attribute;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        $attributes = $request->validated();

        if ($request->password) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
        }
        if ($request->hasFile("image")) {
            
            if (File::exists("assets/img/avatar/" . auth()->user()->image)) {
                File::delete("assets/img/avatar/" . auth()->user()->image);
            }
            
            $file = $request->file("image");
            $attributes['image'] = time() . "_" . $file->getClientOriginalName();
            $file->move(("assets/img/avatar/"), $attributes ['image']);
            
        }
        

        $user = User::findOrFail(auth()->user()->id);
        $user->image = $attributes['image'];
        $user->save();
        $user->update($attributes);


        return redirect()->back()->with('success', 'Profile updated.');
    }

}
