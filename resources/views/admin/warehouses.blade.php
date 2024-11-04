<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>WareHouses Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet"  href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{ url('resources/css/warehouse.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                    <h2>WareHouses Management</h2>
                    @if(session('success'))
                        <div class="alert alert-success" id="success-alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- Add New Button -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addWarehouseModal">
                        Add New
                    </button>
                </div>
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Location</th>
                            <th>Joining date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($warehouseDetails as $warehouseDetail)
                            <tr>
                                <td>{{ $warehouseDetail->name . ' ' . $warehouseDetail->last_name }}</td>
                                <td>{{ $warehouseDetail->email }}</td>
                                <td>{{ $warehouseDetail->country_code . $warehouseDetail->mobile }}</td>
                                <td>{{ $warehouseDetail->state }}</td>
                                <td>{{ $warehouseDetail->created_at }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!-- Toggle Switch -->
                                        <label class="switch mr-2">
                                            <input type="checkbox" class="toggle-status" data-user-id="{{$warehouseDetail->id}}" {{$warehouseDetail->status ? 'checked' : ''}}>
                                            <span class="slider round"></span>
                                        </label>
                                        <!-- Settings Icon -->
                                        <a href="{{ route('warehouses.settings', ['id' => $warehouseDetail->id]) }}" class="ml-2">
                                            <i class="fas fa-cog" style="font-size: 1.2rem; cursor: pointer;"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Add Warehouse Modal -->
    <div class="modal fade" id="addWarehouseModal" tabindex="-1" aria-labelledby="addWarehouseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addWarehouseModalLabel">Add New Warehouse</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('warehouses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter first name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter last name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="countryCode" class="form-label">Country Code</label>
                                <input type="text" class="form-control" id="countryCode" name="countryCode" placeholder="Enter country code" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mobile" class="form-label">Mobile No</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile number" required>
                            </div>
                            <!-- Profile Image Input Field -->
                            <div class="col-md-6 mb-3">
                                <label for="profileImage" class="form-label">Profile Image</label>
                                <input type="file" class="form-control" id="profileImage" name="profileImage">
                            </div>
                            <!-- Image Preview Element -->
                            <div class="col-md-6 mb-3">
                                <label for="imagePreview" class="form-label">Image Preview</label>
                                <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 100px; height: auto;" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        new DataTable('#example', {
            stateSave: true
        });
        const userStatusUrl = "{{ route('user.status') }}";
    </script>
    <script src="{{ url('resources/js/warehouse.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
