@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile Setting') }}</div>

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
                    <form action={{ route('users.update-setting', ['user'=> $user->id]) }} method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="notification_switch">Notification Switch:</label>
                            <input type="hidden" name="notification_switch" value="false">
                            <input value="true" type="checkbox" id="notification_switch" name="notification_switch" {{
                                $user->notification_switch ? 'checked' : '' }}>
                            <label class="custom-control-label" for="notification_switch">Enable/Disable</label>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value={{
                                $user->phone_number ? $user->phone_number : ''}}>
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
<script>
    @if(Session::has('message'))
		swal({
				title: "Success!",
				text: "{{ Session::get('message') }}",
				icon: "success",
			})
			.then((value) => {
				window.location.href = "{{ route('users.impersonate', ['user' => $user->id]) }}";
			});
		@endif
</script>
@endsection