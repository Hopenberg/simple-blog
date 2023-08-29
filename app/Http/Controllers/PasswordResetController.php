<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePasswordResetRequest;
use App\Http\Requests\StoreNewPasswordResetRequest;
use App\Jobs\SendPasswordResetMail;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) 
    {
    }

    public function show()
    {
        return view('password-reset', [
            'status' => Session::get('status')
        ]);
    }

    public function reset(CreatePasswordResetRequest $request)
    {
        SendPasswordResetMail::dispatch($request->validated()['email']);

        return back()->with(['status' => 'Email was sent.']);
    }

    public function showNewPassword(string $token)
    {
        return view('show-new-password', ['token' => $token]);
    }

    public function storeNewPassword(StoreNewPasswordResetRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $newDetails = ['password' => $password];
                if (!empty($user->getRememberTokenName()))
                {
                    $newDetails[$user->getRememberTokenName()] = Str::random(60);
                }

                $this->userRepository->updateUser($user->id, $newDetails);
            }
        );
     
        return $status === Password::PASSWORD_RESET
            ? redirect('/login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
