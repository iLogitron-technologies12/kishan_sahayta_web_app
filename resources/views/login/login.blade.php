<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            padding-top: 8.75rem;
            background-color: #fbf9f5;
            padding-bottom: 13.75rem;
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

        .no-select {
            user-select: none;
        }

        #captcha {
            background-color: red;
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

        <h2 class="application-title"> <b>Login</b> </h2>

        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('login') }}">
                        @csrf
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
                            <label for="password" class="col-md-12 col-form-label">Password:</label>
                            <div class="col-md-12">
                                <input type="password" class="form-control input-field-padding" name="password" placeholder="Enter Password" value="{{ old('password') }}" required>
                                @error('password')
                                <div class=" alert alert-danger">{{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row input-field-spaces no-select" oncopy="return false" onpaste="return false" oncut="return false">
                            <label for="captcha" class="col-md-12 col-form-label no-select"> Captcha: <span id="captcha">{{ $captcha_text }}</span></label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding no-select" name="captcha" placeholder="Enter Captcha" value="{{ old('captcha') }}" required oncopy="return false" onpaste="return false" oncut="return false">
                                @error('captcha')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col text-right">
                                <button type="submit" class="btn btn-success submit-class">Submit</button>
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
