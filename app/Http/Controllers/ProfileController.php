<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\UserStatus;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = auth()->user(); // Assuming you are using authentication
        // user status from this user
        $userStatus = UserStatus::where('user_id', $user->id)->first();

        // make user status if not exist for user (user status is a seperate table with user_id)
        if($userStatus == null){
            $newUserStatus = new UserStatus();

            $newUserStatus->user_id = $user->id;
            $newUserStatus->status = 'niet actief';
            $newUserStatus->description = 'deze gebruiker is nog maar net aangemaakt';
            $newUserStatus->created_at = now();
            $newUserStatus->save();
        }

        

        return view('profile.show', compact('user', 'userStatus'));
    }

    public function update(Request $request)
    {
        // Validate the form data
        $request->validate([
            // 'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);
        // dd($request);
        // Get the current user
        $user = Auth::user();
        
        // Update the user's name and email
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address_street = $request->input('street');
        $user->address_nr = $request->input('nr');
        $user->address_city = $request->input('city');
        $user->address_zipcode = $request->input('zipcode');
        
        // save
        $user->save();

        // Redirect the user back to the profile page with a success message
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
