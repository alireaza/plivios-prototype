@extends('tailwind')

@section('content')
    <a href="{{ route('download.index') }}">Back to Downloads</a>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('download.destroy', ['id' => $download->id]) }}">
        @csrf
        @method('DELETE')

        <span>Are you sure for delete {{ $download->name }}?</span>

        <button type="submit">Delete</button>
    </form>
@endsection
