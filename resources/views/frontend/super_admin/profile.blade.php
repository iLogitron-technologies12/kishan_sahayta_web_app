@extends('frontend.super_admin_layouts.main')
@section('main-container')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .card-body {
        max-height: auto !important;
        overflow-y: scroll !important;
    }

    .filter-form {
        margin-left: 30px;
    }

    .alert-danger {
        color: #ff0018;
        background-color: initial;
        border-color: initial;
        border: none;
    }

    .alert-danger.alert {
        border: none;
        padding: 0px !important;
        color: red;
        position: relative;
        margin: 0px;
    }

    .extra-padding-while-showing-error-in-change-password {
        padding: .75rem 1.25rem !important;
    }

    .alert-success .alert {
        color: #fff;
        background-color: #28a745;
        border-color: #23923d;
        padding: .75rem 1.25rem !important;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .show-password {
        text-align: end;
        margin-bottom: -20px;
    }

    .show-password:hover {
        cursor: pointer;
    }

    .card-body {
        overflow-y: hidden !important;
    }

    .add-agri-expert {
        font-weight: 600 !important;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <!-- <div class="col-sm-6">
                    <h1 class="add-agri-expert">Edit Profile</h1>
                </div> -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manage Applications</li> -->
                        <!-- <li class="breadcrumb-item active"><a href="/officer/dashboard"> Relaod Table </a></li> -->
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

                        <div class="card-body">
                            <h5 class="add-agri-expert" style="font-size: 1rem; margin-bottom:8px; color:#007bff;">Edit Profile</h5>
                            <div style="border-bottom: 1px solid #b8b4b4; margin-top: 10px; margin-bottom: 10px;">

                            </div>
                            <form method="post" action="{{ route('super_admin.save_profile_changes')}}">
                                @csrf

                                <input type="hidden" name="profile_changes" value="profile_changes">

                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ old('name', $name) }}" required>
                                        @error('name')
                                        <div class=" alert alert-danger">{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for="email">Email/Username</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ old('email', $email) }}" required>
                                        @error('email')
                                        <div class=" alert alert-danger">{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group  col-md-12 col-sm-12">
                                        <label for="mobile_number">Mobile Number</label>
                                        <input type="number" class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter Mobile Number" value="{{ old('mobile_number', $mobile_no) }}" required>
                                        @error('mobile_number')
                                        <div class=" alert alert-danger">{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-12 col-sm-12 text-md-right">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card" style="margin-top: 25px; margin-bottom: 35px">
                        <!-- /.card-body (for change password)-->


                        <div class="card-body">

                            <h5 class="add-agri-expert" style="font-size: 1rem; margin-bottom:8px; color:#007bff;">Change Password</h5>

                            <div style="border-bottom: 1px solid #b8b4b4; margin-top: 10px; margin-bottom: 10px;">
                            </div>

                            <form method="post" action="{{ route('super_admin.save_profile_changes')}}">
                                @if(isset($success_message))
                                <div class="alert alert-success">
                                    {{ $success_message }}
                                </div>
                                @endif

                                @if(session('success_after_changing_password'))
                                <div class="alert alert-success">
                                    {{ session('success_after_changing_password') }}
                                </div>
                                @endif

                                @if(session('error_when_changing_password'))
                                <div class="alert alert-danger extra-padding-while-showing-error-in-change-password" style="margin-top:10px;
                                    color: #fff;
                                    background-color: #dc3545;
                                    border-color: #d32535;
                                    position: relative;
                                    padding: .75rem 1.25rem !important;
                                    margin-bottom: 1rem;
                                    border: 1px solid transparent;
                                    border-radius: .25rem;
                                ">
                                    {{ session('error_when_changing_password') }}
                                </div>
                                @endif
                                @csrf

                                <input type="hidden" name="password_changes" value="password_changes">

                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter Current Password" value="{{ old('password') }}" required>
                                        <div class="show-password">
                                            <a onclick="showCurrentPassword()" id="show_or_hide_current_password_text">show password</a>
                                        </div>
                                    </div>
                                    @error('current_password')
                                    <div class=" alert alert-danger">{{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for="password">New Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password" value="{{ old('password') }}" required>
                                        <div class="show-password">
                                            <a onclick="showPassword()" id="show_or_hide_password_text">show password</a>
                                        </div>
                                    </div>
                                    @error('password')
                                    <div class=" alert alert-danger">{{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12 col-sm-12">
                                        <label for="confirm_password">Confirm New Password</label>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter Confirm New Password" value="{{ old('confirm_password') }}">
                                        <div class="show-password">
                                            <a onclick="showConfirmPassword()" id="show_or_hide_confirm_password_text">show password</a>
                                        </div>
                                    </div>
                                    @error('confirm_password')
                                    <div class=" alert alert-danger">{{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12 col-sm-12 text-md-right">
                                    <button type="submit" class="btn btn-primary" style="margin-top:20px;">Change Password</button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->

            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<script>
    $('#mobile_number').on('input', function() {
        var maxLength = 10;
        var phoneNumber = $(this).val().replace(/\D/g, '');
        var truncatedPhoneNumber = phoneNumber.substring(0, maxLength);

        $(this).val(truncatedPhoneNumber);
    });

    // $(document).getElementById('reset_all_fields').reset();

    function showCurrentPassword() {
        let value = document.getElementById('show_or_hide_current_password_text');

        let x = document.getElementById("current_password");
        if (x.type === "password") {
            value.innerText = "hide password"
            x.type = "text";
        } else {
            x.type = "password";
            value.innerText = "show password"
        }
    }

    function showPassword() {
        let value = document.getElementById('show_or_hide_password_text');

        let x = document.getElementById("password");
        if (x.type === "password") {
            value.innerText = "hide password";
            x.type = "text";
        } else {
            x.type = "password";
            value.innerText = "show password"
        }
    }

    function showConfirmPassword() {
        let value = document.getElementById('show_or_hide_confirm_password_text');

        let x = document.getElementById("confirm_password");
        if (x.type === "password") {
            value.innerText = "hide password"
            x.type = "text";
        } else {
            x.type = "password";
            value.innerText = "show password"
        }
    }
</script>
@endsection
