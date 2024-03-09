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

        /* .card {
            margin-top: 50px;
        } */

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

        /* 5********************************************************************************* */
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            background-color: #f8f9fa;
            padding: 15px;
            margin: 0 auto;
            width: 70%;
            border: 1px solid #ddd;
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

        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title mb-4 text-center">Application Details</h2>

                    <!-- <div class="form-group">
                <label class="font-weight-bold">Applicant Name:</label>
                <p class="form-control-static">{{$application_details['name_of_applicant']}}</p>
            </div> -->

                    <div class="alert alert-info">
                        <strong>APPLICANT NAME:</strong> {{$application_details['name_of_applicant']}}
                    </div>

                    <div class="alert alert-success">
                        <strong>AUTO GENERATED APPLICATION NUMBER:</strong> {{$application_details['application_id']}}
                    </div>

                    <div class="alert alert-secondary">
                        <strong>APPLIED DATE:</strong> {{$application_details['updated_at']}}
                    </div>

                    <div class="alert alert-warning">
                        <strong>DISTRICT:</strong> {{$application_details['district']}}
                    </div>

                    <!-- <div class="alert alert-primary">
                        <strong>WARD/GP/VC:</strong> {{$application_details['ward_gp_vc']}}
                    </div> -->

                    <div class="alert alert-danger">
                        <strong>STATUS OF THE APPLICATION:</strong>

                        @if($application_details['status'] == 1)
                        <td>Submitted by Applicant</td>
                        @elseif($application_details['status'] == 2)
                        <td>Submitted by Applicant</td>
                        @elseif($application_details['status'] == 3)
                        <td>Submitted by Applicant</td>
                        @elseif($application_details['status'] == 4)
                        <td>Submitted by Applicant</td>
                        @elseif($application_details['status'] == 5)
                        <td>Submitted by Applicant</td>
                        @elseif($application_details['status'] == 6)
                        <td>Application Approved</td>
                        @elseif($application_details['status'] == 7)
                        <td>Application Rejected</td>
                        @else
                        <td>...</td>
                        @endif
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
                $('#submit_button').prop('disabled', false);

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
