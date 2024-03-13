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
                <div class="col-sm-6">
                    <h1 class="add-agri-expert">Add Agri Experts</h1>
                </div>
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


                    {{--
                    <div class="card">
                        <div class="card-header">
                            <form method="post" action="{{ route('officer.application_filter') }}">
                    @csrf
                    <span>
                        Sub Division(Agri/Horti):
                        <select name="sub_division">
                            <option value="{{ $sub_division }}">{{ $sub_division }}</option>
                        </select>
                    </span>

                    <span class="filter-form">
                        Block:
                        <select name="block" id="block">
                            <option value="Select Block">Select Block</option>
                            @foreach($blocks as $block)
                            <option value="{{ $block->ulb }}">{{ $block->ulb }}</option>
                            @endforeach
                        </select>
                    </span>

                    <span class="filter-form">
                        <button type="submit" style="background-color: #343a40; color: white; border-radius: 15px;">Show Applications</button>
                    </span>
                    </form>
                </div>
                --}}
                <!-- /.card-header -->
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('super_admin.create_agri_expert')}}">
                            @csrf

                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="name">Name of the Agri Expert</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <div class=" alert alert-danger">{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="designation">Designation</label>
                                    <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter Designation" value="{{ old('designation') }}" required>
                                    @error('designation')
                                    <div class=" alert alert-danger">{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class=" alert alert-danger">{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="mobile_number">Mobile Number</label>
                                    <input type="number" class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter Mobile Number" value="{{ old('mobile_number') }}" required>
                                    @error('mobile_number')
                                    <div class=" alert alert-danger">{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" value="{{ old('password') }}" required>
                                    <div class="show-password">
                                        <a onclick="showPassword()" id="show_or_hide_password_text">show password</a>
                                    </div>

                                    @error('password')
                                    <div class=" alert alert-danger">{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group  col-md-6 col-sm-12">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter Confirm Password" value="{{ old('confirm_password') }}">
                                    <div class="show-password">
                                        <a onclick="showConfirmPassword()" id="show_or_hide_confirm_password_text">show password</a>
                                    </div>
                                    @error('confirm_password')
                                    <div class=" alert alert-danger">{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <button type="reset" id="reset_all_fields" class="btn btn-secondary">Reset all fields</button>
                                </div>
                                <div class="form-group col-md-6 col-sm-12 text-md-right">
                                    <button type="submit" class="btn btn-primary">Add Agri Expert</button>
                                </div>
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

    function showPassword() {
        let value = document.getElementById('show_or_hide_password_text');
        // console.log(value.innerHTML);

        let x = document.getElementById("password");
        if (x.type === "password") {
            value.innerText = "hide password"
            x.type = "text";
        } else {
            x.type = "password";
            value.innerText = "show password"
        }
    }

    function showConfirmPassword() {
        let value = document.getElementById('show_or_hide_confirm_password_text');
        // console.log(value.innerHTML);

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
