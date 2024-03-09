<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


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
                        <button type="button" class="btn btn-success edit-button" data-toggle="modal" data-target="#editModal{{ $user->id }}">Edit</button>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit User Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" class="row g-3" action="{{ route('edit-user', ['id' => $user->id]) }}">
                @csrf
                @method('PUT') <!-- Use PUT method for update -->

                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="inputEmail4" value="{{ $user->name }}">
                    </div>
                    <div class="col-md-12">
                        <label for="inputPassword4" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="inputPassword4" value="{{ $user->email }}">
                    </div>
                    <!-- Add other fields as needed -->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>




                        <button type="button" class="btn btn-danger edit-button" data-bs-toggle="modal" id="edit_user_details">Delete</button>
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
