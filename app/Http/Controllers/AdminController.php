<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

use function Laravel\Prompts\confirm;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function AdminLogin(Request $request)
    {
        return view('admin.admin_login');
    }


    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin__profile_view', compact('profileData'));
    }

    public function AdminProfileStore(Request  $request)
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
            @unlink(public_path('upload/admin_images/.$data->photo')); // Deleting the Old Photo
            $filename = date('ymdHi') . $file->getClientOriginalName(); // Generating a Unique Filename
            $file->move(public_path('upload/admin_images'), $filename); // Moving the File to the Desired Directory
            $data['photo'] = $filename; //Updating the Database with the New Filename
        }
        $data->save();

        $notificaiton = array(
            'message' => 'User Profile Updated Sucessfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notificaiton);
    }

    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password', compact('profileData'));
    }


    public function AdminPasswordUpdate(Request $request)
    {

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = array(
                'messsage' => 'old_password does not match!',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }

        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'messsage' => 'Password Change SuccessFully',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }
}
