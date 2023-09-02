@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Post Notification') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-group">
                            @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
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
                            <label for="short_text">Message</label>
                            <input value="{{old('message')}}" type="text" name="message" id="message"
                                class="form-control" placeholder="Enter Message" required>
                        </div>

                        <div class="form-group">
                            <label for="destination">Destination</label>
                            <select name="destination" id="destination" class="form-control">
                                <option value="">Select Destination</option>
                                <option value="specific_user">Specific User</option>
                                <option value="all_users">All Users</option>
                            </select>
                        </div>

                        <div class="form-group" id="specificUserDropdown" style="display: none;">
                            <label for="user_id">Select User</label>
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="">Select User</option>
                                @if($userList->isNotEmpty())
                                @foreach($userList as $userOption)
                                <option value="{{ $userOption->id }}">{{ $userOption->name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Post Notification</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
    // Listen for changes in the "Destination" dropdown
    $('#destination').on('change', function() {
        if ($(this).val() == 'specific_user') {
            $('#specificUserDropdown').show();
        } else {
            $('#specificUserDropdown').hide();
        }
    });
});
</script>
@endsection