<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Phone Number</title>
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

        .form-background {
            padding-top: 12.75rem;
            background-color: #fbf9f5;
            padding-bottom: 40.75rem;
        }

        .application-title {
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

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <h2 class="application-title"> <b>Verify OTP</b> </h2>

        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <form method="post" route=" {{ ('verify-otp') }}">
                        @csrf

                        <div class="form-group row input-field-spaces">
                            <label for="otp" class="col-md-12 col-form-label">OTP:</label>
                            <div class="col-md-12">
                                <input type="number" class="form-control input-field-padding" name="otp" placeholder="Enter the OTP recieved" value="{{ old('otp') }}" required>
                                @error('otp')
                                <div class=" alert alert-danger">{{ $message }}
                                </div>
                                @enderror

                                <div class="row">
                                    <div class="col text-right">
                                        <a href="/success"><button type="submit" class="btn btn-success submit-class">Submit</button> </a>

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
