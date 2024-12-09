<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function Index()
    {
        return view('frontend.index');
    }

    public function UserProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('frontend.dashboard.edit_profile', compact('profileData'));
    }


    public function UserStore(Request  $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->photo = $request->photo;
        $data->address = $request->address;


        if ($request->file('photo')) {
            $file = $request->file('photo'); //Retrieving the Uploaded File
            @unlink(public_path('upload/user_images/.$data->photo')); // Deleting the Old Photo
            $filename = date('ymdHi') . $file->getClientOriginalName(); // Generating a Unique Filename
            $file->move(public_path('upload/user_images'), $filename); // Moving the File to the Desired Directory
            $data['photo'] = $filename; //Updating the Database with the New Filename
        }
        $data->save();

        $notificaiton = array(
            'message' => 'User Profile Updated Sucessfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notificaiton);
    }
}
