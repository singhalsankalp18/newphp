<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet"  href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ url('resources/css/usermanagement.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3" style="width: 20%;">
                @include('layouts.sidebar')
            </div>
            <div class="col-md-9"  style="width: 78.5%;">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between topmargin">
            <h2>User Management</h2>
        </div>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Joining date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userDetails as $userDetail)
                            <tr>
                                <td>{{ $userDetail->name . ' ' . $userDetail->last_name }}</td>
                                <td>{{$userDetail->email}}</td>
                                <td>{{$userDetail->country_code . $userDetail->mobile}}</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" class="toggle-status" data-user-id="{{$userDetail->id}}" {{$userDetail->status ? 'checked' : ''}}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>{{ $userDetail->created_at->format('Y-M-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        new DataTable('#example', {
            stateSave: true
        });
        const userStatusUrl = "{{ route('user.status') }}";
    </script>
    <script src="{{ url('resources/js/usermanagement.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>