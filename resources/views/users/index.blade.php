@extends('layouts.app') {{-- Assuming you have a master layout --}}

@section('content')
<div class="container">
    <h1>User List</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Unread Notifications</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>
                    <a href={{ route('users.impersonate', ['user'=> $user->id]) }}>
                        {{ $user->name }}
                    </a>
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_number ?? 'NA'}}</td>
                <td>{{ $user->notifications_count ?? 0}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection