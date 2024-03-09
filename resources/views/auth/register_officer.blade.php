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

        .card {
            margin-top: 50px;
        }

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

        <h2 class="application-title"> <b>Register</b> </h2>

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
                            <label for="email" class="col-md-12 col-form-label">Email:</label>
                            <div class="col-md-12">
                                <input type="email" class="form-control input-field-padding" name="email" placeholder="Enter Email-Id" value="{{ old('email') }}" required>
                                @error('email')
                                <div class=" alert alert-danger">{{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row input-field-spaces">
                            <label for="mobile_no" class="col-md-12 col-form-label">Phone Number:</label>
                            <div class="col-md-12">
                                <input type="number" class="form-control input-field-padding" name="mobile_no" placeholder="Enter Phone number" value="{{ old('mobile_no') }}" required>
                                @error('mobile_no')
                                <div class=" alert alert-danger">{{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row input-field-spaces">
                            <!-- Adjust the label and select names as needed -->
                            <label for="subdivision" class="col-md-12 col-form-label">Sub Division <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <select class="form-control" name="sub_division" id="subdivision">
                                    <option value="">Select Sub Division</option>
                                    <option value="KamalPur">KamalPur</option>
                                    <option value="Gandacherra">Gandacherra</option>
                                    <option value="Longtharai Valley">Longtharai Valley</option>
                                    <option value="Ambassa">Ambassa</option>
                                    <option value="Panisagar">Panisagar</option>
                                    <option value="Kanchanpur">Kanchanpur</option>
                                    <option value="Dharmanagar">Dharmanagar</option>
                                    <option value="Santirbazar">Santirbazar</option>
                                    <option value="Belonia">Belonia</option>
                                    <option value="Sabroom">Sabroom</option>
                                    <option value="Jirania">Jirania</option>
                                    <option value="Mohanpur">Mohanpur</option>
                                    <option value="Sadar">Sadar</option>
                                    <option value="Khowai">Khowai</option>
                                    <option value="Teliamura">Teliamura</option>
                                    <option value="Jampuijala">Jampuijala</option>
                                    <option value="Sonamura">Sonamura</option>
                                    <option value="Bishalgarh">Bishalgarh</option>
                                    <option value="Karbook">Karbook</option>
                                    <option value="Udaipur">Udaipur</option>
                                    <option value="Amarpur">Amarpur</option>
                                    <option value="Kailashahar">Kailashahar</option>
                                    <option value="Kumarghat">Kumarghat</option>
                                </select>
                            </div>
                            @error('sub_division')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label for="password" class="col-md-12 col-form-label">Password:</label>
                            <div class="col-md-12">
                                <input type="password" class="form-control input-field-padding" name="password" placeholder="Enter Password" value="{{ old('password') }}" required>
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
