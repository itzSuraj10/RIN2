@extends('layouts.app') {{-- Assuming you have a master layout --}}

@section('content')
<div class="container">
    <h1>User List</h1>

    <form class="d-flex col-md-6" id="search" action={{ route('users.index') }} method="GET">
        <input class="form-control me-2" type="search" name="search" placeholder="Search by name or email"
            aria-label="Search">

        <button class="btn btn-outline-success me-2" type="submit">Search</button>
    </form>

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
                <td>{{ $user->unread_notifications_count}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection