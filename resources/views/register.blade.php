
@section('content')
<div style="text-align:center;">
    <h1> Add User </h1>
</div>

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



<table class="table table-striped" style="overflow-x: scroll;">
    <thead>
        <tr>
            <th scope="col">SL No.</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            @if ($role == 'sadmin' || $role == 'manager')
            <th scope="col">Actions</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @if (!empty($all_users))
        @foreach ($all_users as $key => $user)
        <tr>
            <th scope="row">{{ $key+1 }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <!-- Edit button with Confirmation modal -->
                @if ($role == 'sadmin' || $role == 'manager')

                <button type="button" class="btn btn-success edit-button" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" data-user-email="{{ $user->email }}" onclick="sendData()" id="edit_user_details">Edit</button>

                <!-- Edit Confirmation Modal -->
                <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmationModalLabel">Edit User Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
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
                            </div>
                            <div class="modal-footer">
                                <!-- Form for Editing inside the modal body -->
                                <form action="{{ route('delete-user', ['id' => $user->id]) }}" method="post">
                                    @csrf
                                    <!-- Submit the form when the "Save" button in the modal is clicked -->
                                    <button type="submit" class="btn btn-success">Save</button>
                                </form>

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if ($role == 'sadmin')

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
                @endif

            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>


{{--
<form method="POST" class="row g-3" action="{{ route('register')}}">
@csrf
<div class="col-md-12">
    <label for="inputEmail4" class="form-label">Name</label>
    <input type="text" class="form-control" name="name" id="inputEmail4">
</div>
<div class="col-md-12">
    <label for="inputPassword4" class="form-label">Email</label>
    <input type="email" class="form-control" name="email" id="inputPassword4">
</div>
<div class="col-md-12">
    <label for="inputAddress" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="inputAddress">
</div>
<div class="col-12" style="margin-top:10px;">
    <button type="submit" class="btn btn-success">Sign up</button>
</div>
</form>
--}}

<!-- Button trigger modal -->
@if ($role == 'sadmin' || $role == 'manager' || $canCreate == 1 )
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="float:right;">
        + Add User
    </button>
@endif


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" class="row g-3" action="{{ route('register')}}">
                    @csrf
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="inputEmail4">
                    </div>
                    <div class="col-md-12">
                        <label for="inputPassword4" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="inputPassword4">
                    </div>
                    <div class="col-md-12">
                        <label for="inputPassword4" class="form-label">Role</label>
                        <select class="form-control" name="role" id="role">
                            @foreach ($all_roles as $role)
                            <option value="{{ $role->id }}">{{ $role->code }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="inputAddress" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="inputAddress">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Sign up</button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->

