<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Include Montserrat font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,600,700,700i&display=swap" rel="stylesheet">
    <style>
        body {
            font: 400 1rem/1.625rem "Montserrat", sans-serif;
        }

            /* .card {
                margin-top: 50px;
            } */

        body{
            background-color: #fbf9f5;
        }

        .application-title {
            margin-top:50px;
            text-align: center;
        }

        .submit-class {
            margin: 15px 0px 0px 0px;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body>


    <div class="form-background">
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

        <h2 class="application-title"> <b>Profile</b> </h2>

        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('register.officer') }}">
                        @csrf
                        <div class="form-group row input-field-spaces">
                            <label for="name" class="col-md-12 col-form-label">Name:</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" name="name" placeholder="Enter Name" value="{{ old('name') }}" required>
                                @error('name')
                                <div class=" alert alert-danger">{{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label for="password" class="col-md-12 col-form-label">New Password:</label>
                            <div class="col-md-12">
                                <input type="password" class="form-control input-field-padding" name="password" placeholder="Enter New Password" value="{{ old('password') }}" required>
                                @error('password')
                                <div class=" alert alert-danger">{{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label for="password" class="col-md-12 col-form-label">Confirm New Password:</label>
                            <div class="col-md-12">
                                <input type="password" class="form-control input-field-padding" name="password" placeholder="Enter Confirm New Password" value="{{ old('password') }}" required>
                                @error('password')
                                <div class=" alert alert-danger">{{ $message }}
                                </div>
                                @enderror
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success submit-class">Submit</button>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>

</html>
