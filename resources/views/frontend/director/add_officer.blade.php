@extends('frontend.director_layout.main')
@section('main-container')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-Xr1jDBiZpMQVd6uT6ddByVyZd17elFIdoPkFpFZtdvP+80UZd1EJAPoRT2ELBPD2" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy7Q1NlZ1/Z9vN2xI/O6/nJDO6JdTRxSkI" crossorigin="anonymous"></script>
<style>
    .card-body {
        max-height: auto !important;
        overflow-y: scroll !important;
    }

    .filter-form {
        margin-left: 30px;
    }

    .delete-icon-space {
        margin-left: 15px;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Officers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manage Applications</li> -->
                        <li class="breadcrumb-item active"><a href="/officer/dashboard"> Relaod Table </a></li>
                    </ol>
                </div>
                @if(isset($success_message))
                <div class="alert alert-success">
                    {{ $success_message }}
                </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger" style="margin-top:10px;">
                    {{ session('error') }}
                </div>
                @endif
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
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="text-right">
                                <button type="button" style="margin-bottom:10px;" data-toggle="modal" data-target="#add_user_modal">Add Officer</button>
                            </div>
                            <!-- code of modal for adding user starts here -->

                            <div class="modal fade" id="add_user_modal" tabindex="-1" role="dialog" aria-labelledby="widerModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="widerModalLabel">Add Officer</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" id="add_user_form">
                                                <meta name="csrf-token" content="{{ csrf_token() }}">

                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="user_id" value="">
                                                    <label for="subdivision">Sub Division:</label>
                                                    <select name="subdivision" id="subdivision" class="form-control">
                                                        <option value="">--Select--</option>
                                                        @foreach($sub_divisions as $subdivision)
                                                        <option value="{{ $subdivision->subdivision }}">{{ $subdivision->subdivision }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="userName">User Name:</label>
                                                    <input type="text" class="form-control" id="officer_name" placeholder="Enter user name" value="">
                                                </div>

                                                <div class="form-group">
                                                    <label for="userName">User Email:</label>
                                                    <input type="email" class="form-control" id="officer_email_add" placeholder="Enter user name" value="">
                                                    Note: This Email ID will be used for logging in to the system.
                                                </div>

                                                <div class="form-group">
                                                    <label for="password">Password:</label>
                                                    <input type="password" class="form-control" id="password" placeholder="Enter password" value="" required>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="showPassword">
                                                        <label class="form-check-label" for="showPassword">Show Password</label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="confirmPassword">Confirm Password:</label>
                                                    <input type="password" class="form-control" id="confirm_password" placeholder="Enter confirm password" value="" required>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Add Officer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- code of modal for adding user ends here -->
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Name </th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($users as $index => $user)
                                    <tr>
                                        <td>{{ $user['id'] }}</td>
                                        <td>{{ $user['name'] }}</td>
                                        <td>{{ $user['email'] }}</td>
                                        <td>
                                            <i class="fas fa-edit edit-icon" data-toggle="modal" data-target="#editModal{{ $user['id'] }}"></i>
                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $user['id'] }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="update_user_form_{{ $user['id'] }}" class="update_user_form" action="/director/update-details-officer" method="post">
                                                                <meta name="csrf-token" content="{{ csrf_token() }}">

                                                                <input type="hidden" class="form-control" id="idUpdate_{{ $user['id'] }}" value="{{ $user['id'] }}">
                                                                <div class="form-group">
                                                                    <label for="userName">User Name:</label>
                                                                    <input type="text" class="form-control" id="nameUpdate_{{ $user['id'] }}" placeholder="Enter user name" value="{{ $user['name'] }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="userEmail">Email:</label>
                                                                    <input type="email" class="form-control" id="emailUpdate_{{ $user['id'] }}" placeholder="Enter email" value="{{ $user['email'] }}" required>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <i id="delete_officer_{{ $user['id'] }}" class="delete_officer fas fa-trash delete-icon-space" action="/director/delete-officer" method="post" ></i> -->
                                            <!-- <i id="delete_officer_{{ $user['id'] }}" class="delete_officer fas fa-trash delete-icon-space" action="/director/delete-officer" method="post"></i> -->

                                            <i class="fas fa-trash delete-icon-space" data-toggle="modal" data-target="#deleteModal{{ $user['id'] }}"></i>
                                            <div class="modal fade" id="deleteModal{{ $user['id'] }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Are you Sure you want to delete this user ?</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="delete_user_form_{{ $user['id'] }}" class="delete_user_form" action="/director/delete-officer" method="post">
                                                                <meta name="csrf-token" content="{{ csrf_token() }}">

                                                                <input type="hidden" class="form-control" id="idDelete_{{ $user['id'] }}" value="{{ $user['id'] }}">
                                                                <div class="form-group">
                                                                    <label for="userName" >ID:</label> {{ $user['id'] }}
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="userName">User Name:</label> {{ $user['name'] }}
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="userEmail">Email:</label> {{ $user['email'] }}
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <!-- <td><button type="button">View Application</button></td> -->

                                    </tr>
                                    @endforeach
                                </tbody>
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>


<script>
    $(document).ready(function() {

        $('#block').on('change', function() {
            let block = $('#block').val();
            $.ajax({
                url: '/all-wards-gp-vc',
                type: 'GET',
                data: {
                    block: block,
                },
                success: function(data) {
                    console.log(data);
                    $('#ward_gp_vc').empty();
                    $.each(data, function(index, value) {
                        $('#ward_gp_vc').append('<option value="' + value + '">' + value + '</option>');
                    });
                }
            });
        });


        $('.delete_user_form').on('submit', function(event) {
            event.preventDefault();

            var form = $(this);
            var user_id = form.find('[id^="idDelete_"]').val();
            var csrf_token = form.find('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/director/delete-officer', // Replace with your update route
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                data: {
                    id: user_id,
                },
                success: function(response) {
                    $('#deleteModal' + user_id).modal('hide');
                    alert('Officer Credentials Deleted Successfully!');
                    window.location.reload();
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });

        $('.update_user_form').on('submit', function(event) {
            event.preventDefault();

            var form = $(this);
            var user_id = form.find('[id^="idUpdate_"]').val();
            var user_name = form.find('[id^="nameUpdate_"]').val();
            var user_email = form.find('[id^="emailUpdate_"]').val();
            var csrf_token = form.find('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/director/update-details-officer', // Replace with your update route
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                data: {
                    id: user_id,
                    name: user_name,
                    email: user_email,
                },
                success: function(response) {
                    $('#editModal' + user_id).modal('hide');
                    alert('Officer Credentials Details Updated Successfully!');
                    window.location.reload();
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });



        $('#add_user_form').submit(function(event) {
            event.preventDefault();

            // let officer_id = $('#user_id').val();
            let officer_name = $('#officer_name').val();
            let officer_email_add = $('#officer_email_add').val();
            let csrf_token = $('meta[name="csrf-token"]').attr('content');
            let subdivision = $('#subdivision').val();
            let password = $('#password').val();
            let confirm_password = $('#confirm_password').val();

            if (password !== confirm_password) {
                alert('Error: Passwords do not match!');
                return;
            }

            $.ajax({
                type: 'POST',
                url: '/director/add-officer?' + new Date().getTime(),
                data: {
                    _token: csrf_token,
                    subdivision: subdivision,
                    officer_name: officer_name,
                    officer_email: officer_email_add,
                    password: password,
                    confirm_password: confirm_password
                },
                cache: false, // Add this line to prevent caching
                success: function(response) {
                    $('#add_user_form').modal('hide');
                    alert('Officer Credentials added Successfully!');
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    var errorMessage = JSON.parse(xhr.responseText);
                    alert('Error: ' + errorMessage.message);
                    window.location.reload();
                }
            });

        });

        // add_user_form

        $("#showPassword").click(function() {
            var passwordField = $("#password");
            var passwordFieldType = passwordField.attr('type');
            if (passwordFieldType === 'password') {
                passwordField.attr('type', 'text');
            } else {
                passwordField.attr('type', 'password');
            }
        });


    });
</script>
@endsection