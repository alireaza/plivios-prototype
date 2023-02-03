@extends('tailwind')

@section('content')
    <a href="{{ route('user.show') }}">Back to User</a>

    <h1>Downloads</h1>
    <a href="{{ route('download.create') }}">Add +</a>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>User</th>
            <th>Name</th>
            <th>URL</th>
            <th>Type</th>
            <th>Frequency (minutes)</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($downloads as $download)
            <tr>
                <td>{{ $download->id }}</td>
                <td>{{ $download->user->name }}</td>
                <td>{{ $download->name }}</td>
                <td>{{ $download->url }}</td>
                <td>{{ $download->type }}</td>
                <td>{{ $download->frequency }}</td>
                <td>
                    <a href="{{ route('download.edit', ['id' => $download->id]) }}">Edit</a>
                    <a href="{{ route('download.delete', ['id' => $download->id]) }}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
