<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Password</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Noto+Sans+JP:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-e7y5ufaXJKCh9g9jtW0f8IRGq9dwbL18nbz4T/6Yd3eViGBoDDKixB8c+yXkaOe8O9bNBqfkRpq8OfW/fn5r6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{url('css/login-page-style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


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



        <div class="form-background">

            <div class="container login-form">
                <div class="row login-form-row">
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md- col-12 column"></div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12 column">
                        <!--  <div class="card">
                <div class="card-body"> -->
                        <div class="forgot-pass-form-body">
                            <h2 class="application-title"> <b>Create Password</b> </h2>
                            <form method="post" action="{{ route('recreate-password') }}">
                                @csrf
                                <div class="row forgot-input-field-spaces">
                                    <label for="text" class="col-md-12 col-form-label">Enter New Password:</label>
                                    <div class="col-md-12">

                                        <i class=" fa fa-eye icon toggle-password"></i>
                                        <input type="password" class="form-input-field" name="new_password" placeholder="Password must be alphanumeric and at least 5 characters long" required>
                                        @error('new_password')
                                        <div class=" alert alert-danger">{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row forgot-input-field-spaces" style="display:none;">

                                    <div class="col-md-12">
                                        <input type="" value="{{ request()->query('phone')}}" class="form-input-field" name="phone">
                                    </div>
                                </div>
                                <div class="row forgot-input-field-spaces">
                                    <label for="text" class="col-md-12 col-form-label">Re-Enter New Password:</label>
                                    <div class="col-md-12">
                                        <i class=" fa fa-eye icon toggle-password"></i>
                                        <input type="password" class="form-input-field" name="re_enter_password" placeholder="Re-Enter New Password" required>
                                        @error('re_enter_password')
                                        <div class=" alert alert-danger">{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row forgot-input-field-spaces">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-success submit-class">Submit</button>

                                    </div>
                                </div>

                            </form>

                        </div>
                        <!--  </div>
            </div> -->
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md- col-12 column"></div>
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
