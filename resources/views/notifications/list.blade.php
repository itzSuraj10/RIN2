@extends('layouts.app')

@section('content')
<div class="container">
    <h2>List Of Posted Notifications</h2>

    <form class="d-flex col-md-10" id="search" action="{{ route('users.list-notification', ['user' => $user->id]) }}"
        method="GET">
        <input class="form-control me-2" type="search" name="search" placeholder="Search by message or type"
            aria-label="Search">

        <button class="btn btn-outline-success me-2" type="submit">Search</button>

        <select class="form-select me-2" name="filter">
            <option value="">Filter by Type</option>
            <option value="marketing">Marketing</option>
            <option value="invoices">Invoices</option>
            <option value="system">System</option>
        </select>

        <button class="btn btn-outline-success" type="submit">Filter</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Message</th>
                <th>Posted At</th>
                <th>Expiration Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notifications as $notification)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $notification->type }}</td>
                <td>{{ $notification->message }}</td>
                <td>{{ $notification->created_at->diffForHumans() }}</td>
                <td>{{ $notification->expires_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection