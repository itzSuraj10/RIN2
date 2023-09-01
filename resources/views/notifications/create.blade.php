@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Notification</h2>

    <form action={{ route('users.store-notification', ['user'=> $user->id]) }} method="POST">
        @csrf

        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control">
                <option value="marketing">Marketing</option>
                <option value="invoices">Invoices</option>
                <option value="system">System</option>
            </select>
        </div>
        <div class="form-group">
            <label for="short_text">Short Text</label>
            <input type="text" name="short_text" id="short_text" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create Notification</button>
    </form>
</div>
@endsection