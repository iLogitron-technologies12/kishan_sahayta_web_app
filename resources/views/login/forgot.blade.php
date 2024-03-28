<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Madimi+One&family=Noto+Sans+JP:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="{{url('css/login-page-style.css')}}">
</head>

<body>


    <div class="form-background">

        <div class="container login-form">
            <div class="row login-form-row">
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md- col-12 column"></div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12 column">
                   <!--  <div class="card">
                <div class="card-body"> -->
                    <div class="forgot-pass-form-body">
                        <h2 class="application-title"> <b>Forgot Password</b> </h2>
                    <form method="post" action="{{ route('check-otp') }}">
                        @csrf
                        <div class="row forgot-input-field-spaces">
                            <label for="phone" class="col-md-12 col-form-label">Phone Number:</label>
                            <div class="col-md-12">
                                <input type="number" class="form-input-field" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter Registered Phone Number"  required>
                               <!--  @error('email')
                                <div class=" alert alert-danger">{{ $message }}
                                </div>
                                @enderror -->
                            </div>
                        </div>
<div id="message"></div>
                        <!--  -->
                        <div class="row forgot-input-field-spaces no-select" oncopy="return false" onpaste="return false" oncut="return false">
                            <div class="col-6 text-right">
                                <button type="button"id="otpbtn"  class="btn btn-success submit-class">Request OTP</button>
                            </div>
                             <div class="col-6">
                                <input type="number" class="form-input-field" name="otp" placeholder="Enter OTP" required oncopy="return false" onpaste="return false" oncut="return false">
                                @if(session('error'))
                           <div class="col-12">
                           <span class="text-danger">{{ session('error') }}</span>
                          </div>
                           @endif
                            </div>

                        </div>

                                <div class="row forgot-input-field-spaces">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-success submit-class">Validate</button>

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
    <script src="{{url('frontend/plugins/jquery/jquery.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $("#message").fadeOut();
            $("#otpbtn").click(function(){

           var phone_number = $("#phone").val();
           $.ajax({
            url:'/generate-otp-for-forget-password',
            type:'GET',
            data:{phone_number:phone_number},
            success:function(data){
                $("#message").html(data);
                $("#message").fadeIn();
            },
           });
        });
        });
    </script>


</body>

</html>
