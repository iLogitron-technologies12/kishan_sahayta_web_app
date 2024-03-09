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

        <h2 class="application-title" style="margin-top:20px;"> <b>View Application</b> </h2>

        <div class="container mt-5">
            <div class="card" style="margin-bottom: 40px;">
                <div class="card-body">
                    <form method="post" route="url('track-application/view-application/' . $id)">
                        @csrf

                        <div class="form-group row input-field-spaces">
                            <label for="name_of_applicant" class="col-md-12 col-form-label">Name of Applicant <span class="text-danger">*</span> </label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" name="name_of_applicant" value="{{ old('application_details', $application_details['name_of_applicant'] ?? '') }}" required disabled>
                                @error('name_of_applicant')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label for="husband_fathers_name" class="col-md-12 col-form-label">Husband/ Father's Name</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" name="husband_fathers_name" value="{{ old('husband_fathers_name', $application_details['husband_fathers_name'] ?? '') }}" disabled>
                                @error('husband_fathers_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label for="email_id" class="col-md-12 col-form-label">Email ID:</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" name="email_id" value="{{ old('email_id', $application_details['email_id'] ?? '') }}"disabled>
                                @error('email_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label for="phone_number" class="col-md-12 col-form-label">Phone Number <span class="text-danger">*</span> </label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" name="phone_number" id="phone_number" value="{{ old('phone_number', $application_details['phone_number'] ?? '') }}" required disabled>
                                @error('phone_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label for="ration_card_number" class="col-md-12 col-form-label">ration Card Number <span class="text-danger">*</span> </label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" name="ration_card_number" id="ration_card_number" value="{{ old('ration_card_number', $application_details['ration_no'] ?? '') }}" required disabled>
                                @error('ration_card_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label for="district" class="col-md-12 col-form-label">District <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <select class="form-control" name="district" id="dist" disabled>
                                    <option value="">Select District</option>
                                    @foreach($districts as $district)
                                    <option value="{{ $district->district }}" {{ $application_details['district'] == $district->district ? 'selected' : '' }} >
                                        {{ $district->district }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('district')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group row input-field-spaces">
                            <label for="subdivision" class="col-md-12 col-form-label">Sub Division <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <select class="form-control" name="sub_division" id="subdivision" disabled>
                                    <option value="{{ $application_details['sub_division'] ?? '' }}">
                                        {{ $application_details['sub_division'] ?? '' }}
                                    </option>
                                </select>
                            </div>
                            @error('sub_division')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="form-group row input-field-spaces">
                            <label for="block" class="col-md-12 col-form-label">Select Block <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <select class="form-control" name="block" id="block" disabled>
                                    <option value="{{ $application_details['sub_division'] ?? '' }}">
                                        {{ $application_details['block'] ?? '' }}
                                    </option>
                                </select>
                            </div>
                            @error('block')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label for="ward_gp_vc" class="col-md-12 col-form-label">Select Ward/GP/VC <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <select class="form-control" name="ward_gp_vc" id="ward_gp_vc" disabled>
                                    <option value="{{ old('ward_gp_vc') }}">
                                        {{ $application_details['ward_gp_vc'] ?? '' }}
                                    </option>
                                </select>
                            </div>
                            @error('ward_gp_vc')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label for="complete_address" class="col-md-12 col-form-label">Complete Address <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <textarea class="form-control" name="complete_address" id="complete_address" rows="4" placeholder="Enter complete address in 150 words" disabled>{{ old('complete_address', $application_details['complete_address'] ?? '') }}</textarea>
                            </div>
                            @error('complete_address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label class="col-md-12 col-form-label">TTAADC Area <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="ttaadc_area" id="ttaadc_area_yes" value="TTAADC AREA" {{ old('ttaadc_area', $application_details['ttaadc_area'] ?? '') == 'TTAADC AREA' ? 'checked' : '' }} disabled>
                                    <label class="form-check-label" for="ttaadc_area_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="ttaadc_area" id="ttaadc_area_no" value="NON TTAADC AREA" {{ old('ttaadc_area', $application_details['ttaadc_area'] ?? '') == 'NON TTAADC AREA' ? 'checked' : '' }} disabled>
                                    <label class="form-check-label" for="ttaadc_area_no">No</label>
                                </div>
                            </div>
                            @error('ttaadc_area')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label for="farming_area_in_acre" class="col-md-12 col-form-label">Farming Area (in Kani ) <span class="text-danger">*</span> </label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" name="farming_area_in_acre" id="farming_area_in_acre" value="{{  old('farming_area_in_acre', $application_details['farming_area_in_acre']) }}" disabled>
                                @error('farming_area_in_acre')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label class="col-md-12 col-form-label">Land Type <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="land_type" id="land_type_yes" value="HILLY AREA" {{ old('land_type', $application_details['land_type'] ?? '') == 'HILLY AREA' ? 'checked' : '' }} disabled>
                                    <label class="form-check-label" for="land_type_yes">Hilly Area</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="land_type" id="land_type_no" value="PLANE LAND" {{ old('land_type', $application_details['land_type'] ?? '') == 'PLANE LAND' ? 'checked' : '' }} disabled>
                                    <label class="form-check-label" for="land_type_no">Plane Land</label>
                                </div>
                            </div>
                            @error('land_type')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Repeat the pattern for other form fields -->

                        <div class="row">
                            <div class="col text-right">
                                <!-- <button type="submit" class="btn btn-success">Submit</button> -->
                                <a href="/"><button type="button" class="btn btn-success ">Submit Later</button> </a>
                                <!-- <a href="/success"><button type="submit" id="submit_button" class="btn btn-success" value="1">Submit Application Now</button> </a> -->
                                <a href="/success"><button type="submit" id="submit_button" class="btn btn-success " name="status" value="1">Submit Now</button> </a>
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
                        console.log(data);
                        $('#subdivision').empty();
                        $.each(data, function(index, value) {
                            $('#subdivision').append('<option value="' + value + '">' + value + '</option>');
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
                            $('#block').append('<option value="' + value + '">' + value + '</option>');
                                // $('#block').append('<option value="' + value.ulb + '">' + value.ulb + '</option>');
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
