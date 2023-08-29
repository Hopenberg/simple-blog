<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function store(RegisterUserRequest $request)
    {
        $user = User::create($request->safe()->only(['name', 'email', 'password']));

        Auth::login($user);

        return redirect('/');
    }
}
