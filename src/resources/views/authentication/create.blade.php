@extends('tailwind')

@section('content')
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('auth.store') }}">
        @csrf

        <label for="email">
            <span>Email:</span>
            <input type="text" id="email" name="email" value="{{ old('email') }}"/>
        </label>

        <label for="password">
            <span>Password:</span>
            <input type="password" id="password" name="password"/>
        </label>

        <button type="submit">Login</button>

        <button type="reset">Reset</button>
    </form>
@endsection
