<?php

namespace App\Http\Controllers;

use Attribute;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {   
        $services = auth()->user()->services()->distinct()->get();
        
        return view('auth.profile',compact('services'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $attributes = $request->validated();

        if ($request->password) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
        }
        if ($request->hasFile("image")) {
            
            if (File::exists("assets/img/avatars/" . auth()->user()->image)) {
                File::delete("assets/img/avatars/" . auth()->user()->image);
            }
            
            $file = $request->file("image");
            $attributes['image'] = time() . "_" . $file->getClientOriginalName();
            $file->move(("assets/img/avatars/"), $attributes ['image']);
            
        }
        

        $user = User::findOrFail(auth()->user()->id);
        $user->image = $attributes['image'];
        $user->save();
        $user->update($attributes);


        return redirect()->back()->with('success', 'Profile updated.');
    }

}
