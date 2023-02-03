@extends('tailwind')

@section('content')
    <form method="POST" action="{{ route('auth.destroy') }}">
        @csrf
        @method('DELETE')

        <button type="submit">Logout</button>
    </form>

    <h1>Welcome {{ $user->name }}!</h1>
    <a href="{{ route('download.index') }}">Downloads</a>
@endsection
