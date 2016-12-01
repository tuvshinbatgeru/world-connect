<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Response;

class AuthController extends Controller
{
    //
    public function checkPassword(Request $request)
    {
        return Response::json([
            'code' => \Hash::check($request->pass, \Auth::user()->password) ? 0 : 1,
        ]);
    }

    public function changePassword(Request $request)
    {
        $newPassword = $request->password;

        \Auth::user()->password = \Hash::make($newPassword);
        \Auth::user()->save();

        return Response::json([
            'code' => 0,
            'message' => 'Амжилттай солилоо.'
        ]);
    }

    public function logout(Request $request)
    {
    	\Auth::logOut();
    	return redirect('login');
    }

    public function login(Request $request)
    {   
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)
        			->first();

        if (!$user)
        {
            $request->session()->flash('alert-danger', 'Нэр болон нууц үгээ зөв оруулна уу!.', 200);
            return redirect()->back();
        }
        if (\Hash::check($password, $user->password))
        {
        	\Auth::login($user);
        	return redirect('admin/country');
        }
        else
        {
            $request->session()->flash('alert-warning', 'Нууц үгээ зөв оруулна уу!.', 200);
            return redirect()->back();
        }
    }
}
