<?php

namespace Modules\Dashboard\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login() {
        return view('dashboard::auth.login');
    }

    public function auth(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'login' => 'required|min:3|max:255',
                'password' => 'required|min:6|max:255'
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors());
            }

            $remember = $request->get('remember') == 'on' ? true : false;
            // проверяем поле логин на e-mail
            if(filter_var($request->get('login'), FILTER_VALIDATE_EMAIL)) {
                if(!Auth::guard('web')->attempt([
                    'email' => $request->get('login'),
                    'password' => $request->get('password'),
                    'status' => 1
                ], $remember)) {
                    throw new \Exception("Неверный логин или пароль.");
                } else {
                    $user = User::where('email', $request->get('login'))->first();

                    if(!empty($user)) {
                        Auth::setUser($user);
                    }
                }
            } else {
                if(!Auth::guard('web')->attempt([
                    'phone' => $request->get('login'),
                    'password' => $request->get('password'),
                    'status' => 1
                ], $remember)) {
                    throw new \Exception("Неверный логин или пароль.");
                } else {
                    $user = User::where('phone', $request->get('login'))->first();

                    if(!empty($user)) {
                        Auth::setUser($user);
                    }
                }
            }


        } catch (\Exception $exception) {
            return redirect()->back()->withErrors($exception->getMessage(), 'general');
        }

        return response()->redirectToRoute('dashboard.index');
    }
}
