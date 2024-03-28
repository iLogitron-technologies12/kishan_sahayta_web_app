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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url('css/login-page-style.css')}}">

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
                                    <i class=" fa fa-eye icon toggle-password"></i>
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
                        <h4 class="forgot-password"><a href="{{ route('forgot-password') }}">Forgot Password?</a></h4>
                    </div>
                    <!--  </div>
            </div> -->
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script>
        $(document).ready(function() {
            $('.toggle-password').click(function() {
                var passwordField = $(this).closest('.row').find('.form-input-field');
                var fieldType = passwordField.attr('type');
                if (fieldType === 'password') {
                    passwordField.attr('type', 'text');
                    $(this).removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordField.attr('type', 'password');
                    $(this).removeClass('fa-eye-slash').addClass('fa-eye');

                }
            });
        });
    </script>
</body>

</html>
