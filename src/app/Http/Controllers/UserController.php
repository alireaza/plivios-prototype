<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserShowRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class UserController extends Controller
{
    public function create(UserCreateRequest $request): View
    {
        return view('user.create');
    }

    public function store(UserStoreRequest $request): Response
    {
        DB::beginTransaction();

        try {
            $attributes = $request->validated();

            $attributes['password'] = Hash::make($attributes['password']);

            User::create($attributes);

            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }

        return redirect()->route('auth.create');
    }

    public function show(UserShowRequest $request): View
    {
        return view('user.show')->with('user', $request->user());
    }
}
