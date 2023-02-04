<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authentication\AuthenticationCreateRequest;
use App\Http\Requests\Authentication\AuthenticationDestroyRequest;
use App\Http\Requests\Authentication\AuthenticationStoreRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationController extends Controller
{
    public function create(AuthenticationCreateRequest $request): View
    {
        if (!session()->has('url.intended')) {
            $url = url()->previous();

            session(['url.intended' => $url]);
        }

        return view('authentication.create');
    }

    public function store(AuthenticationStoreRequest $request): Response
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (session()->has('url.intended')) {
                $url = session()->get('url.intended');

                return redirect()->to($url);
            }

            return redirect()->route('user.show');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function destroy(AuthenticationDestroyRequest $request): Response
    {
        Auth::logout();

        return redirect()->route('auth.create');
    }
}
