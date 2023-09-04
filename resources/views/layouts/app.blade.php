<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Include Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Include Font Awesome CSS from CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">

    <!-- Include CSS and JavaScript assets here -->
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">{{ config('app.name', 'Laravel') }}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users">Users</a>
                    </li>
                    @if(Request::route('user'))
                    <li class="nav-item">
                        <a class="nav-link" href={{ route('users.create-notification', ['user'=> $user->id]) }}>Post
                            Notification</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href={{ route('users.list-notification', ['user'=> $user->id]) }}>List
                            Notification</a>
                    </li>

                    <!-- Notification Counter Icon -->
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bell"><span id="notificationCount">0</span></i>
                        </a>
                        <ul id="notificationsDropdown" class="dropdown-menu" aria-labelledby="notificationDropdown">

                        </ul>
                    </li>

                    <!-- Settings Icon -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="settingsDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-cog"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                            <a class="dropdown-item" href={{ route('users.edit-setting', ['user'=> $user->id])
                                }}>Profile Settings</a>
                        </ul>
                    </li>

                    @endif
                </ul>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="mt-auto bg-light">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12 text-center">
                    Copyright {{ now()->format('Y') }}. All Rights Reserved
                </div>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Bootstrap JavaScript and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    @yield('footer-scripts')

    <script>
        $(document).ready(function() {
            // Function to load notifications and update the notification count
            function loadNotifications() {
                $.ajax({
                    url: "{{ route('users.get-notification', ['user'=> $user->id]) }}",
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        // Update the notification count in the navbar
                        $('#notificationCount').text(response.unreadCount);

                        // Clear and rebuild the notifications dropdown
                        var notificationsDropdown = $('#notificationsDropdown');
                        notificationsDropdown.empty();

                        $.each(response.notifications, function(index, notification) {
                            var createdAt = moment(notification.created_at).fromNow();
                            var notificationLink = $(
                                '<a class="dropdown-item" href="#">' +
                                notification.message + ' - ' +
                                createdAt + '</a>'
                            );

                            notificationLink.click(function() {
                                // Send an AJAX request to mark the notification as read
                                $.ajax({
                                    url: "/users/"  + {{ $user->id }} + "/markNotifyRead/" + notification.id,
                                    type: "POST",
                                    dataType: "json",
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                    },
                                    success: function(resp) {
                                        loadNotifications();
                                    },
                                    error: function(error) {
                                        console.error(error);
                                    }
                                });
                            });
                            

                            notificationsDropdown.append(notificationLink);
                            notificationsDropdown.append('<hr class="dropdown-divider">');
                        });
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
            @if(isset($user->id))
            // Load notifications on page load
            loadNotifications();
            @endif
        });
    </script>
</body>

</html>