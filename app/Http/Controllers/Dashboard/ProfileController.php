<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Http\Requests\ProfileRequest;
// use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function editProfile() {
        $admin = Admin::find(auth('admin')->user() -> id);
        return view('dashboard.profile.edit', compact('admin'));
    }

    public function updateProfile(ProfileRequest $request) {
        // validate
        // update

        // try {

            $admin = Admin::find(auth('admin') -> user() -> id);
            unset($request['id'], $request['password_confirmation']); // delete it from request

            // check if password is written
            if ($request->filled('password')) {
                $request->merge(['password' => bcrypt($request->password)]);
                $admin -> update($request -> all());
            }
            // return $request;

            $admin -> update($request -> only(['name', 'email']));
            // $admin -> update($request -> all());

            return redirect() -> back() -> with(['success' => 'تم التحديث بنجاح']);

        // } catch (\Exception $ex) {
        //     return $ex;
        //     return redirect() -> back() -> with(['error' => 'هناك خطأ ما، حاول مرة أخرى']);
        // }
    }
}
