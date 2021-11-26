<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class LoginController extends Controller
{

    /**
     * @param AuthenticateRequest $request
     * @return RedirectResponse
     */
    public function authenticate(AuthenticateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        /** @var User $user */
        $user = User::query()->where('username', $data['username'])->where('password', $data['password'])->first();

        if (is_null($user))
            return back()->with('error', 'Username or password incorrect.');
        else {

            if ($request->has('remember'))
                auth()->login($user, true);
            else
                auth()->login($user);

            if ($user->isAdmin())
                return redirect()->intended('admin/dashboard');
            else
                return redirect()->intended();
        }
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
