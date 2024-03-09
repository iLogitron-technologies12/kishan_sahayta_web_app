<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Noto+Sans+JP:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <style>
        body {
            font: 400 1rem/1.625rem "Montserrat", sans-serif;
        }

        .card {
            margin-top: 50px;
        }

        .form-background {
            background-image: linear-gradient(to right, rgba(43, 162, 11), rgba(255, 0, 0, 0));
            background-size: cover;
            background-position: center;
            height: 100vh;
            width: 100vw;
        }

        .login-form {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .login-form-row {
            /* height: 60vh;*/
        }

        .column {
            padding: 0 !important;
        }

        .application-title {
            text-align: center;
            font-family: "Madimi One", sans-serif;
        }

        .forgot-password {
            text-align: center;
        }

        .form-body {
            background: rgb(227, 253, 220);
            height: 100%;
            padding: 10px 25px;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            box-shadow: 10px 10px 8px #888888;
        }

        .login-page-image {
            height: 100%;
            width: 100%;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }

        .form-input-field {
            background-color: #FFFFFF;
            border: 1px solid #AFFC9A;
            border-radius: 20px;
            padding: 5px 31px;
            margin-bottom: 10px;
            width: 100%;
            -webkit-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
            font-size: 14px !important;
            font-weight: 500 !important;
        }

        #captcha {
            user-select: none;
            font-family: Arial, sans-serif;
            font-size: 15px;
            font-weight: bolder;
            letter-spacing: 5px;
            /* Adjust as needed */
            color: #333;
            /* Adjust color as needed */
            /* text-transform: uppercase; */
            border: 1px solid #ccc;
            padding: 5px;
            display: inline-block;
            margin-bottom: 5px;
            outline: none;
        }

        input:focus {
            outline: none;
        }

        .forgot-password {
            font-size: 15px;
            margin-top: 10px;
        }

        .forgot-password a {
            text-decoration: none;
            color: #DC033B;
            font-weight: bolder;
        }

        .col-form-label {
            font-weight: bolder;
        }

        .submit-class {
            width: 100%;
            border-radius: 20px;
        }

        @media(max-width: 768px) {
            .form-body {
                background: #DAF2FC;
                height: 100%;
                padding: 10px 25px;
                border-bottom-right-radius: 20px;
                border-bottom-left-radius: 20px;
                border-top-right-radius: 0;
                box-shadow: 10px 10px 8px #888888;
            }

            .login-page-image {
                height: 100%;
                width: 100%;
                border-top-right-radius: 20px;
                border-top-left-radius: 20px;
                border-bottom-left-radius: 0;
            }

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

        <!-- <h2 class="application-title"> <b>Login</b> </h2> -->

        <div class="container login-form">
            <div class="row login-form-row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12 column"><img class="login-page-image" src="crop.jpg"></div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12 column">
                    <div class="form-body">
                        <h2 class="application-title"> <b>Login</b> </h2>
                        <form method="post" action="{{ route('login') }}">
                        @csrf
                            <div class="row input-field-spaces">
                                <label for="email" class="col-md-12 col-form-label">Email:</label>
                                <div class="col-md-12">
                                    <input type="email" class="form-input-field" name="email" placeholder="Enter Email-Id" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class=" alert alert-danger">{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <label for="password" class="col-md-12 col-form-label">Password:</label>
                                <div class="col-md-12">
                                    <input type="password" class="form-input-field" name="password" placeholder="Enter Password" value="{{ old('password') }}" required>
                                    @error('password')
                                    <div class=" alert alert-danger">{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row input-field-spaces no-select" oncopy="return false" onpaste="return false" oncut="return false">
                                <label for="captcha" class="col-6 col-form-label no-select"> Captcha: <span id="captcha">{{ $captcha_text }}</span></label>
                                <div class="col-6">
                                    <input type="text" class="form-input-field" name="captcha" placeholder="Enter Captcha" required oncopy="return false" onpaste="return false" oncut="return false">
                                    @error('captcha')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-success submit-class">Submit</button>
                                </div>
                            </div>
                        </form>
                        <h4 class="forgot-password"><a href="#">Forgot Password?</a></h4>
                    </div>
                    <!--  </div>
            </div> -->
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
