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
            
            if (File::exists("assets/img/avatars/" . auth()->user()->avatar)) {
                File::delete("assets/img/avatars/" . auth()->user()->avatar);
            }
            
            $file = $request->file("image");
            $attributes['avatar'] = time() . "_" . $file->getClientOriginalName();
            $file->move(("assets/img/avatars/"), $attributes ['avatar']);
            
        }
        

        $user = User::findOrFail(auth()->user()->id);
        $user->avatar = $attributes['avatar'];
        $user->save();
        $user->update($attributes);


        return redirect()->route('dashboard')->with('success', 'Profile updated.');
    }

}
