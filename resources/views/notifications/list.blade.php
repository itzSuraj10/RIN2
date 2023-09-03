@extends('layouts.app')

@section('content')
<div class="container">
    <h2>List of Posted Notifications</h2>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Message</th>
                <th>Posted At</th>
                <th>Expiration Date</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach ($notifications as $notification)
            <tr>
                <td>{{ $notification->id }}</td>
                <td>{{ $notification->type }}</td>
                <td>{{ $notification->message }}</td>
                <td>{{ $notification->created_at->diffForHumans() }}</td>
                <td>{{ $notification->expires_at }}</td>
                <!-- Add more columns as needed -->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection