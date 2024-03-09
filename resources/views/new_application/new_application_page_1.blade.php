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

        <h2 class="application-title" style="margin-top:20px;"> <b>New Application</b> </h2>

        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <form method="post" route=" {{ ('new-application') }}">
                        @csrf

                        <div class="form-group row input-field-spaces">
                            <label for="name_of_applicant" class="col-md-12 col-form-label">Name of Applicant <span class="text-danger">*</span> (Mandatory Field)</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" name="name_of_applicant" value="{{ old('name_of_applicant') }}" required>
                                @error('name_of_applicant')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label for="gender" class="col-md-12 col-form-label">Gender <span class="text-danger">*</span> (Mandatory Field)</label>
                            <div class="col-md-12">
                                <select class="form-control input-field-padding" name="gender" required>
                                    <option value="">Select</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Others" {{ old('gender') == 'Others' ? 'selected' : '' }}>Others</option>
                                </select>
                                @error('gender')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row input-field-spaces">
                            <label for="husband_fathers_name" class="col-md-12 col-form-label">Husband/ Father's Name</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" name="husband_fathers_name" value="{{ old('husband_fathers_name') }}">
                                @error('husband_fathers_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label for="email_id" class="col-md-12 col-form-label">Email ID:</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" name="email_id" value="{{ old('email_id') }}">
                                @error('email_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label for="phone_number" class="col-md-12 col-form-label">Phone Number <span class="text-danger">*</span> (Mandatory Field)</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" required>
                                @error('phone_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label for="ration_card_number" class="col-md-12 col-form-label">Ration Card Number <span class="text-danger">*</span> (Mandatory Field)</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" name="ration_card_number" id="ration_card_number" value="{{ old('ration_card_number') }}" required>
                                @error('ration_card_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Repeat the pattern for other form fields -->

                        <div class="row">
                            <div class="col text-right">
                                <!-- <button type="submit" class="btn btn-success">Submit</button> -->
                                <a href="/success"><button type="submit" id="submit_button" class="btn btn-success ">Next</button> </a>

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

            // Initially disable the submit button
            $('#submit_button').prop('disabled', true);

            $('#phone_number').on('input', function() {
                var maxLength = 10;
                var phoneNumber = $(this).val().replace(/\D/g, ''); // Remove non-numeric characters
                var truncatedPhoneNumber = phoneNumber.substring(0, maxLength); // Truncate to maxLength digits

                // Set the input value to the truncated phone number
                $(this).val(truncatedPhoneNumber);
            });

            $('#ration_card_number').on('input', function() {
                var maxLength = 12;
                var phoneNumber = $(this).val().replace(/\D/g, ''); // Remove non-numeric characters
                var truncatedPhoneNumber = phoneNumber.substring(0, maxLength); // Truncate to maxLength digits

                // Set the input value to the truncated phone number
                $(this).val(truncatedPhoneNumber);
            });


            $('#ration_card_number').on('input', function() {
                var ration_card_number = $(this).val();
                var submit_button = $('#submit_button');

                if (ration_card_number.length < 12) {
                    submit_button.prop('disabled', true);
                } else {
                    submit_button.prop('disabled', false);
                }
            });

            $('#name_of_applicant, #ration_card_number, #phone_number').on('input', function() {
                var name_of_applicant = $('#name_of_applicant').val();
                var ration_card_number = $('#ration_card_number').val();
                var phone_number = $('#phone_number').val();
                var submit_button = $('#submit_button');

                // Check if all conditions are met
                var is_name_valid = name_of_applicant.trim() !== ''; // Check if the name has a value
                var is_ration_card_valid = ration_card_number.length === 12; // Check if ration card has 12 digits
                var is_phone_valid = phone_number.length === 10; // Check if phone number has 10 digits

                // Enable the submit button if all conditions are met
                submit_button.prop('disabled', !(is_name_valid && is_ration_card_valid && is_phone_valid));
            });


            $('#dist').on('change', function() {
                let district = $('#dist').val();
                $.ajax({
                    url: '/all-sub-divisions',
                    type: 'GET',
                    data: {
                        district: district
                    },
                    success: function(data) {
                        $('#subdivision').empty();
                        $.each(data, function(index, value) {
                            $('#subdivision').append('<option value="' + value.subdivision + '">' + value.subdivision + '</option>');
                        });
                    }
                });
            });

            $('#subdivision').on('change', function() {
                let subDivision = $('#subdivision').val();
                if (subDivision) {
                    $.ajax({
                        url: '/all-blocks',
                        type: 'GET',
                        data: {
                            sub_division: subDivision
                        },
                        success: function(data) {
                            console.log(data);
                            $('#block').empty();
                            $.each(data, function(index, value) {
                                $('#block').append('<option value="' + value.ulb + '">' + value.ulb + '</option>');
                            });
                        }
                    });
                } else {
                    // Handle the case where subDivision is undefined or empty
                    console.error('subDivision is undefined or empty');
                }
            });
        });
    </script>


</body>

</html>
