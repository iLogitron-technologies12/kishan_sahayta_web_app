<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Application Form</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Include Montserrat font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,600,700,700i&display=swap" rel="stylesheet">
    <style>
        body {
            font: 400 1rem/1.625rem "Montserrat", sans-serif;
            background-color: #fbf9f5;
        }

        .input-field-spaces {
            margin-top: 15px;
        }

        .input-field-padding {
            padding: 5px;
        }

        .card {
            margin-top: 50px;
        }

        /* .form-background {
            padding-top: 4.75rem;
            background-color: #fbf9f5;
            padding-bottom: 4.75rem;
        } */

        .application-title {
            text-align: center;
        }

        .text-danger {
            color: red;
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

        <h2 class="application-title" style="margin-top:20px;"> <b>OTP has been shared successfully in your provided Phone Number</b> </h2>

        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <form method="post" route=" {{ ('new-application') }}">
                        @csrf
                        We are facing some trouble with SMS Gateway. Kindly input <b> {{ $otp }} </b>as your OTP.
                        <div class="form-group row input-field-spaces">
                            <label for="name_of_applicant" class="col-md-12 col-form-label">Name of Applicant </label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" name="name_of_applicant" value="{{ $name_of_applicant }}" disabled>
                                @error('name_of_applicant')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label for="phone_number" class="col-md-12 col-form-label">Phone Number </label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" name="phone_number" id="phone_number" value="{{ $phone_number }}" disabled>
                                @error('phone_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row input-field-spaces">
                            <label for="otp" class="col-md-12 col-form-label">Enter OTP sent to Phone <span class="text-danger">*</span> (Mandatory Field)</label>
                            <div class="col-md-12">
                                <input type="number" class="form-control input-field-padding" name="otp" id="otp" value="{{ old('otp') }}" required>
                                @error('phone_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row input-field-spaces">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success" id="verifyOtp">Verify OTP</button>
                                <button type="button" class="btn btn-primary" id="resend_otp">Resend OTP</button>
                            </div>
                        </div>
                        <div id="otpMessageContainer" class="alert alert-info" style="display: none;"></div>


                        <!-- <div class="row">
                            <div class="col text-right">
                                <a href="/success"><button type="submit" class="btn btn-success ">Next</button> </a>
                            </div>
                        </div> -->

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#otp').on('input', function() {
                var maxLength = 6;
                var phoneNumber = $(this).val().replace(/\D/g, ''); // Remove non-numeric characters
                var truncatedPhoneNumber = phoneNumber.substring(0, maxLength); // Truncate to maxLength digits

                // Set the input value to the truncated phone number
                $(this).val(truncatedPhoneNumber);
            });

            $('#resend_otp').on('click', function() {
                // Display a message in the container
                $('#otpMessageContainer').text('OTP has been resent. Check your phone.').removeClass('alert-danger').addClass('alert-info').show();
            });

            $('#otpMessageContainer').click(function() {
                $(this).css('display', 'none');
            });

        });
    </script>


</body>

</html>
