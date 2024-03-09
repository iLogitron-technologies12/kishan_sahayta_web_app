@extends('frontend.layouts.main')
@section('main-container')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<style>
    .alert {
        margin-left: 250px;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>All Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Users</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Demo Title</h3>
                        </div>

                    </div>


                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Price</th>
                                        <th>Brand</th>
                                        <th>Per Bundle</th>
                                        <th>Bundle Price</th>
                                        <th>Bundle Qnty</th>
                                        <th>Updated at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($all_users as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user['name'] }}</td>
                                        <td>{{ $user['email'] }}</td>
                                        <td>{{ $user['price'] }}</td>
                                        <td>{{ $user['brand'] }}</td>
                                        <td>{{ $user['per_bundle'] }}</td>
                                        <td>{{ $user['bundle_price'] }}</td>
                                        <td>{{ $user['bundle_quantity'] }}</td>
                                        <td>{{ $user['updated_at'] }}</td>
                                        <td>
                                            <button type="button" class="btn btn-success edit-button" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" data-user-email="{{ $user->email }}" onclick="sendData()" id="edit_user_details">Edit</button>

                                            <!-- Edit Confirmation Modal -->
                                            <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                                                <div class="modal-dialog modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmationModalLabel">Edit User Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" class="row g-3" action="{{ route('edit-user',['id' => $user->id] )}}">
                                                                @csrf
                                                                <div class="col-md-12">
                                                                    <label for="inputEmail4" class="form-label">Name</label>
                                                                    <input type="text" class="form-control" name="name" id="inputEmail4" value="{{ $user->name }}">
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="inputPassword4" class="form-label">Email</label>
                                                                    <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <!-- Form for Editing inside the modal footer -->
                                                            <form action="{{ route('delete-user', ['id' => $user->id]) }}" method="post">
                                                                @csrf
                                                                <!-- Submit the form when the "Save" button in the modal is clicked -->
                                                                <button type="submit" class="btn btn-success">Save</button>
                                                            </form>

                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete button with confirmation modal -->
                                            <button type="button" class="btn btn-danger edit-button" data-bs-toggle="modal" data-bs-target="#confirmationModal{{ $user->id }}">Delete</button>

                                            <!-- Delete Confirmation Modal -->
                                            <div class="modal fade" id="confirmationModal{{ $user->id }}" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                                                <div class="modal-dialog modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmationModalLabel">Delete Confirmation</h5>
                                                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this user?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <!-- Form for deletion inside the modal body -->
                                                            <form action="{{ route('delete-user', ['id' => $user->id]) }}" method="post">
                                                                @csrf
                                                                <!-- Submit the form when the "Delete" button in the modal is clicked -->
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>

                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Price</th>
                                        <th>Brand</th>
                                        <th>Per Bundle</th>
                                        <th>Bundle Price</th>
                                        <th>Bundle Qnty</th>
                                        <th>Updated at</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->



                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
