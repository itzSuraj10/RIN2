@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Impersonating User: {{ $user->name }}</h2>

    <!-- Display User Info -->

    <h3>Unread Notifications</h3>
    <a href="{{ route('users.mark-all-as-read', ['user' => $user->id]) }}">Mark All as Read</a>
    <ul>
        @foreach($notifications as $notification)
        <li>
            <a href="{{ route('users.mark-as-read', ['user' => $user->id, 'notification' => $notification->id]) }}">
                {{ $notification->message }}
            </a>
        </li>
        @endforeach
    </ul>
</div>
@endsection