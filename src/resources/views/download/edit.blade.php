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

    <form method="POST" action="{{ route('download.update', ['id' => $download->id]) }}">
        @csrf
        @method('PATCH')

        <label for="name">
            <span>Name:</span>
            <input type="text" id="name" name="name" value="{{ old('name', $download->name) }}"/>
        </label>

        <label for="url">
            <span>URL:</span>
            <input type="text" id="url" name="url" value="{{ old('url', $download->url) }}"/>
        </label>

        <label for="type">
            <span>Type:</span>
            <select id="type" name="type">
                <option value="data" @if(old('type', $download->type) === 'data') selected @endif>Data</option>
            </select>
        </label>

        <label for="frequency">
            <span>Frequency:</span>
            <input type="text" id="frequency" name="frequency" value="{{ old('frequency', $download->frequency) }}"/>
        </label>

        <button type="submit">Update</button>

        <button type="reset">Reset</button>
    </form>
@endsection
