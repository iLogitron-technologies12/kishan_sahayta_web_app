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

        <h2 class="application-title" style="margin-top:20px;"> <b>Track Your Application</b> </h2>

        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                <form method="post" action="{{ url('track-application') }}">
    @csrf

    <div class="form-group row input-field-spaces">
        <label for="otp" class="col-md-12 col-form-label">Enter Phone Number you have used while filling up the Application <span class="text-danger">*</span></label>
        <div class="col-md-12">
            <input type="number" class="form-control input-field-padding" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" required>
            @error('phone_number')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col text-right">
            <button type="submit" id="submit_button" class="btn btn-success">Next</button>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {

//            $('#submit_button').prop('disabled',true);

            $('#phone_number').on('input', function() {
                var maxLength = 10;
                var phoneNumber = $(this).val().replace(/\D/g, ''); // Remove non-numeric characters
                var truncatedPhoneNumber = phoneNumber.substring(0, maxLength); // Truncate to maxLength digits

                // Set the input value to the truncated phone number
                $(this).val(truncatedPhoneNumber);
            });

            // $('#phone_number').on('input', function() {
            //     var phone_number = $(this).val();
            //     // alert(phone_number);
            //     var submit_button = $('#submit_button');

            //     if (phone_number.length < 10) {
            //         submit_button.prop('disabled', true);
            //     } else {
            //         submit_button.prop('disabled', false);
            //     }
            // });

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
