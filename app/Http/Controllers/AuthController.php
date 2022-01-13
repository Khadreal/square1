<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;

class AuthController extends Controller
{

    /**
     * Login view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    */
    public function login()
    {
        return view('frontend.auth.login')
            ->with( 'title', 'Login' );
    }

    /**
     * Login process
     * 
     * @param LoginFormRequest $request
     * 
     * 
    */
    public function loginProcess(LoginFormRequest $request)
    {
        $user = Auth::attempt(['email' => $request->input('identity'), 'password' => $request->input('password') ]);

        if(!$user) {
            return redirect()
                ->back()
                ->withInput()
                ->with('danger', 'Invalid login details');
        }

    }

    /**
     * Register view
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    */
    public function register()
    {
        return view('frontend.auth.register')
            ->with('title', 'Register');
    }

    /**
     * @param RegisterFormRequest $request
     * 
    */
    public function registerProcess(RegisterFormRequest $request)
    {
        $data = $request->all();
        $data['username'] = strstr($data['email'], '@', true);

        $user = User::create($data);
        
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Account succesfully created');
    }
}
