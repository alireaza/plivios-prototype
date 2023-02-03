@extends('tailwind')

@section('content')
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('user.store') }}">
        @csrf

        <label for="name">
            <span>Name:</span>
            <input type="text" id="name" name="name" value="{{ old('name') }}"/>
        </label>

        <label for="email">
            <span>Email:</span>
            <input type="text" id="email" name="email" value="{{ old('email') }}"/>
        </label>

        <label for="password">
            <span>Password:</span>
            <input type="password" id="password" name="password"/>
        </label>

        <label for="password_confirmation">
            <span>Confirm Password:</span>
            <input type="password" id="password_confirmation" name="password_confirmation"/>
        </label>

        <button type="submit">Register</button>

        <button type="reset">Reset</button>
    </form>
@endsection
