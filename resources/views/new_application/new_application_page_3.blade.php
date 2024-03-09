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
    @if($errors->any())
    <div class="alert alert-danger">
        There were errors with your submission. Please review and correct them.
    </div>
    @endif

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

        <h2 class="application-title" style="margin-top:20px;"> <b>Address</b> </h2>

        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <form method="post" route=" {{ ('new-application') }}" enctype="multipart/form-data">
                        @csrf


                        <div class="form-group row input-field-spaces">
                            <label for="district" class="col-md-12 col-form-label">District <span class="text-danger">*</span> (Mandatory Field)</label>
                            <div class="col-md-12">
                                <select class="form-control" name="district" id="dist">
                                    <option value="">Select District</option>
                                    @foreach($districts as $district)
                                    <option value="{{ $district->district }}" >
                                   {{--  <option value="{{ $district->district }}" {{ old('district') == $district->district ? 'selected' : '' }}>  --}}
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
                            <!-- Adjust the label and select names as needed -->
                            <label for="subdivision" class="col-md-12 col-form-label">Sub Division(Agri/Horti) <span class="text-danger">*</span> (Mandatory Field)</label>
                            <div class="col-md-12">
                                <select class="form-control" name="sub_division" id="subdivision">
                                    <option value="" {{ old('sub_division') }}>Select Sub Division</option>
                                </select>
                            </div>
                            @error('sub_division')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group row input-field-spaces">
                            <!-- Adjust the label and select names as needed -->
                            <label for="block" class="col-md-12 col-form-label">Select Block <span class="text-danger">*</span> (Mandatory Field)</label>
                            <div class="col-md-12">
                                <select class="form-control" name="block" id="block">
                                    <option value="" {{ old('block') }}>Select Sub Division</option>
                                </select>
                            </div>
                            @error('block')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--*************NEW Update on 26/01/2024 ****************-->
                        <div class="form-group row input-field-spaces">
                            <label for="revenue_circle" class="col-md-12 col-form-label">Revenue Circle</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" placeholder="Enter the name of Revenue Circle" name="revenue_circle" id="revenue_circle" value="{{ old('revenue_circle') }}">
                                
                            </div>
                         </div>
                         <div class="form-group row input-field-spaces">
                            <label for="tehsil" class="col-md-12 col-form-label">Tehsil</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" placeholder="Enter the name of Tehsil" name="tehsil" id="tehsil" value="{{ old('tehsil') }}">
                                
                            </div>
                         </div>
                         <div class="form-group row input-field-spaces">
                            <label for="mouja" class="col-md-12 col-form-label">Mouja</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" placeholder="Enter the name of Mouja" name="mouja" id="mouja" value="{{ old('mouja') }}">
                                
                            </div>
                         </div>
    
<!-- *******************According to new update ward/GP/VC will bot be available*************Ujjal Sarkar**** -->
                        <!-- <div class="form-group row input-field-spaces"> -->
                            <!-- *****Adjust the label and select names as needed**** -->
                            <!-- <label for="ward_gp_vc" class="col-md-12 col-form-label">Select GP/VC <span class="text-danger">*</span> (Mandatory Field)</label>
                            <div class="col-md-12">
                                <select class="form-control" name="ward_gp_vc" id="ward_gp_vc">
                                    <option value="" {{ old('ward_gp_vc') }}>Select GP/VC</option>
                                </select>
                            </div>
                            @error('ward_gp_vc')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div> -->

                        <div class="form-group row input-field-spaces">
                            <!-- Adjust the label and textarea names as needed -->
                            <label for="complete_address" class="col-md-12 col-form-label">Complete Address <span class="text-danger">*</span> (Mandatory Field)</label>
                            <div class="col-md-12">
                                <textarea class="form-control" name="complete_address" id="complete_address" rows="4" placeholder="Enter complete address in 150 words">{{ old('complete_address') }}</textarea>
                            </div>
                            @error('complete_address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group row input-field-spaces">
                            <!-- Adjust the label and radio button names as needed -->
                            <label class="col-md-12 col-form-label">TTAADC Area <span class="text-danger">*</span> (Mandatory Field)</label>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="ttaadc_area" id="ttaadc_area_yes" value="TTAADC AREA" {{ old('ttaadc_area') == 'TTAADC AREA' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="ttaadc_area_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="ttaadc_area" id="ttaadc_area_no" value="NON TTAADC AREA" {{ old('ttaadc_area') == 'NON TTAADC AREA' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="ttaadc_area_no">No</label>
                                </div>
                            </div>
                            @error('ttaadc_area')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label for="farming_area_in_acre" class="col-md-12 col-form-label">Area Available for Oil Palm Cultivation (in Kani    ) <span class="text-danger">*</span> (Mandatory Field)</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" name="farming_area_in_acre" id="farming_area_in_acre" value="{{ old('farming_area_in_acre') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 5)">
                                @error('farming_area_in_acre')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row input-field-spaces">
                            <!-- Adjust the label and radio button names as needed -->
                            <label class="col-md-12 col-form-label">Land Type <span class="text-danger">*</span> (Mandatory Field)</label>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="land_type" id="land_type_yes" value="UP LAND" {{ old('land_type') == 'UP LAND' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="land_type_yes">Up Land</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="land_type" id="land_type_no" value="PLAIN LAND" {{ old('land_type') == 'PLANE LAND' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="land_type_no">Plain Land</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="land_type" id="land_type_no" value="MIDDLE LAND" {{ old('land_type') == 'MIDDLE LAND' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="land_type_no">Middle Land</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="land_type" id="land_type_no" value="OTHER LAND" {{ old('land_type') == 'OTHER LAND' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="land_type_no">Other Land</label>
                                </div>
                            </div>
                            @error('land_type')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row input-field-spaces">
                            <label for="bank_name" class="col-md-12 col-form-label"> Bank Name<span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" placeholder="Enter the name of Farmers Bank" name="bank_name" id="bank_name" value="{{ old('bank_name') }}">
                                
                            </div>
                            @error('bank_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row input-field-spaces">
                            <label for="beneficiary_name" class="col-md-12 col-form-label"> Beneficiary Name<span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" placeholder="Enter the bank beneficiary name" name="beneficiary_name" id="beneficiary_name" value="{{ old('beneficiary_name') }}">
                
                            </div>
                            @error('beneficiary_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row input-field-spaces">
                            <label for="account_number" class="col-md-12 col-form-label">Account Number<span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" placeholder="Enter the Bank Account Number" name="account_number" id="account_number" value="{{ old('account_number') }}">
                
                            </div>
                            @error('account_number')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row input-field-spaces">
                            <label for="confirm_account_number" class="col-md-12 col-form-label">Confirm Account Number<span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" placeholder="Enter the Bank Account Number" name="confirm_account_number" id="confirm_account_number" value="{{ old('confirm_account_number') }}">
                
                            </div>
                            @error('confirm_account_number')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row input-field-spaces">
                            <label for="ifsc_code" class="col-md-12 col-form-label">IFSC Code<span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" placeholder="Enter the IFSC Code" name="ifsc_code" id="ifsc_code" value="{{ old('ifsc_code') }}">
                
                            </div>
                            @error('ifsc_code')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label for="ration_card_number" class="col-md-12 col-form-label">ration Card Number <span class="text-danger">*</span> (Mandatory Field)</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" name="ration_card_number" value="{{ $ration_card_number }}" disabled>
                                @error('ration_card_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row input-field-spaces">
                           <div class="col-6">
                            <label for="lin_type" class="col-md-12 col-form-label">Land Identification Number Type</label>
                            <div class="col-md-12">
                                <select class="form-control" name="type_of_land_indentification_no" id="lin_type">
                                    <option value="Khatian Number" {{ old('lin_type') }}>Khatian Number</option>
                                    <option value="RS/Hal Plot Number" {{ old('lin_type') }}>RS/Hal Plot Number</option>
                                    <option value="CS/Sabek Plot Number" {{ old('lin_type') }}>CS/Sabek Plot Number</option>
                                </select>
                            </div>
                           </div>
                           <div class="col-6">
                            <label for="land_indentification_no" class="col-md-12 col-form-label">Land Identification Number</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control input-field-padding" placeholder="Enter Land Identification Number" name="land_indentification_no" id="land_indentification_no" value="{{ old('land_indentification_no') }}">
                                
                            </div>
                           </div>
                         </div>









                        <div class="form-group row input-field-spaces">
                            <label for="ration_card_upload" class="col-md-12 col-form-label">Upload ration Card <span class="text-danger">*</span> (Mandatory Field)</label>
                            <div class="col-md-12">
                                <input type="file" class="form-control-file" name="ration_card_upload" id="ration_card_upload" accept=".jpg, .jpeg, .png, .pdf">
                                <span id="file_size_error" class="text-danger" style="display:none;">File size must be less than 5 MB.</span>
                                @error('ration_card_upload')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row input-field-spaces">
                            <label for="supporting_land_document_upload" class="col-md-12 col-form-label">Upload Supporting Land Document <span class="text-danger">*</span> (Mandatory Field)</label>
                            <div class="col-md-12">
                                <!-- <input type="file" class="form-control-file" name="supporting_land_document_upload" id="supporting_land_document_upload" accept=".jpg, .jpeg, .png, .pdf"> -->
                                <input type="file" class="form-control-file" name="supporting_land_document_upload" id="supporting_land_document_upload" accept=".pdf">

                                <span id="file_size_error" class="text-danger" style="display:none;">File size must be less than 5 MB.</span>
                                @error('supporting_land_document_upload')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div id="otpMessageContainer" class="alert alert-info" style="display: none;"></div>


                        <div class="row">
                            <div class="col text-right">
                                <!-- <button type="submit" class="btn btn-success">Submit</button> -->
                                <button type="submit" id="save_application" class="btn btn-success " name="status" value="0">Save as Draft</button>
                                <button type="submit" id="submit_button" class="btn btn-success " name="status" value="1">Submit Now</button>
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
            $('#save_application').prop('disabled', true);

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
                $.ajax({
                    url: '/all-blocks',
                    type: 'GET',
                    data: {
                        sub_division: subDivision
                    },
                    success: function(data) {
                        console.log(data);
                        $('#block').empty();
                        // $('#block').append('<option value="' +  + '">' + Select .Sub .Division + '</option>');
                        $.each(data, function(index, value) {
                            $('#block').append('<option value="' + value + '">' + value + '</option>');
                        });
                    }
                });
            });


            $('#block').on('change', function() {
                let block = $('#block').val();
                $.ajax({
                    url: '/all-wards-gp-vc',
                    type: 'GET',
                    data: {
                        block: block,
                    },
                    success: function(data) {
                        console.log(data);
                        $('#ward_gp_vc').empty();
                        $.each(data, function(index, value) {
                            $('#ward_gp_vc').append('<option value="' + value + '">' + value + '</option>');
                        });
                    }
                });
            });


            $('#ration_card_upload').change(function() {
                var fileSize = this.files[0].size; // in bytes
                var maxSize = 5 * 1024 * 1024; // 5 MB

                if (fileSize > maxSize) {
                    $('#file_size_error').show();
                    $(this).val(''); // Clear the file input
                } else {
                    $('#file_size_error').hide();
                }
            });

            $('#supporting_land_document_upload').change(function() {
                var fileSize = this.files[0].size; // in bytes
                var maxSize = 5 * 1024 * 1024; // 5 MB

                if (fileSize > maxSize) {
                    $('#file_size_error').show();
                    $(this).val(''); // Clear the file input
                } else {
                    $('#file_size_error').hide();
                    $('#submit_button').prop('disabled', false);
                    $('#save_application').prop('disabled', false);
                }
            });

            // $('#dist').on('change', function() {
            //     var selected_district = $(this).val();
            //     var submit_button = $('#submit_button');

            //     var is_district_valid = selected_district !== '';

            //     submit_button.prop('disabled', !is_district_valid);
            // });

            // $('#subdivision').on('change', function() {
            //     var selected_sub_division = $(this).val();
            //     var submit_button = $('#submit_button');

            //     var is_selected_sub_division_valid = selected_sub_division !== '';

            //     submit_button.prop('disabled', !is_selected_sub_division_valid);
            // });

        });
    </script>

</body>

</html>
