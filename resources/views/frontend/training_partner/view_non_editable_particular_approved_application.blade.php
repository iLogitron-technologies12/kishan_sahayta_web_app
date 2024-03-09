<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Physically Verified Application Form</title>
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
            /* padding: 15px; */
            margin: 0 auto;
            /* width: 70%; */
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

        <div class="container mt-2">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title mb-4 text-center">Application Details</h2>

                    <strong>APPLICATION NUMBER:</strong> {{$application_details['application_id']}}
                    <div class="alert alert-info">

                        <strong>APPLICANT NAME:</strong> {{$application_details['name_of_applicant']}} <br>

                        <strong>HUSBAND/ FATHER'S NAME:</strong> {{$application_details['husband_fathers_name']}} <br>

                        @if(isset($application_details['email_id']) && !empty($application_details['email_id']))
                        <strong>EMAIL ID:</strong> {{$application_details['email_id']}} <br>
                        @endif

                        <strong>PHONE NUMBER:</strong> {{$application_details['phone_number']}} <br>

                        <strong>RATION NUMBER:</strong> {{$application_details['ration_no']}} <br>

                        <strong>DOWNLAOD RATION:</strong>

                        <a href="{{ asset('storage/' . $application_details['ration_card_image_path']) }}" download>
                            Download Ration Card Image
                        </a>
                    </div>

                    <div class="alert alert-secondary">

                        <strong>DISTRICT:</strong> {{$application_details['district']}} <br>

                        <strong>SUB DIVISION(Agri/Horti):</strong> {{$application_details['sub_division']}} <br>

                        <strong id="block">BLOCK:</strong> {{$application_details['block']}} <br>
                        <strong id="block">Bank Name:</strong> {{$application_details['bank_name']}}<br>
                        <strong id="block">Beneficiary Name:</strong> {{$application_details['beneficiary_name']}}<br>
                        <strong id="block">Account Number:</strong> {{$application_details['account_number']}}<br>
                        <strong id="block">IFSC Code:</strong> {{$application_details['ifsc_code']}}<br>

                        <!-- <strong id="block">WARD/GP/VC:</strong> {{$application_details['ward_gp_vc']}} <br> -->

                        <strong id="block">COMPLETE ADDRESS:</strong> {{$application_details['complete_address']}} <br>

                        @if(isset($application_details['ttaadc_area']) && $application_details['ttaadc_area'] == 'TTAADC AREA')
                        <strong>TTAADC AREA:</strong> Yes <br>
                        @else
                        <strong>TTAADC AREA:</strong> No <br>
                        @endif

                    </div>

                    <div class="alert alert-warning">
                        <strong>LAND TYPE :</strong> {{$application_details['land_type']}} <br>
                        <strong>Area(in kani) :</strong> {{$application_details['farming_area_in_acre']}}
                    </div>


                    <div class="alert alert-danger">
                        <strong>APPLIED DATE & TIME:</strong> {{$application_details['updated_at']}}
                    </div>

                    <div class="alert alert-primary">
                        <strong>STATUS OF THE APPLICATION:</strong>
                        @if($application_details['status'] == 1)
                        <td>Submitted by Applicant</td>
                        @elseif($application_details['status'] == 2)
                        <td>Physically Verified</td>
                        @elseif($application_details['status'] == 3)
                        <td>Sent for Approval</td>
                        @elseif($application_details['status'] == 4)
                        <td>Approved for Plantation</td>
                        @elseif($application_details['status'] == 5)
                        <td>Application Rejected</td>
                        @elseif($application_details['status'] == 6)
                        <td>Applicant Enrolled For Training</td>
                        @elseif($application_details['status'] == 7)
                        <td>Teaining Complated</td>
                        @elseif($application_details['status'] == 8)
                        <td>Plant's Alloted</td>
                        @else
                        <td>...</td>
                        @endif
                    </div>

                    @if($coordinates != 'no_coordinates')
                    <div class="alert alert-success">
                        GIS Location: <a href="https://www.google.com/maps/dir/?api=1&destination={{  $coordinates->latitude  }},{{ $coordinates->longitude }}" target="_blank">Get Directions</a>
                    </div>
                    @endif


                </div>

                <div class="card-body d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" onclick="window.open('/print-application/{{ $application_details['id'] }}', '_blank')">Print Application</button>

                    <a href="{{ asset('storage/' . $application_details['any_supporting_land_document_path']) }}" download>
                        Download Supporting Land Doc
                    </a>

                    @if($status == 1)
                    <form method="POST" action="{{ route('training_partner.physical_verify', ['id' => $application_details['id']]) }}" id="gps_form">
                        @csrf
                        <input type="hidden" name="approval_value" value="2">

                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">

                        <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure, you want to verify the application?')">Physically Verify!</button>
                    </form>

                    @elseif($status == 2)
                    <form method="POST" action="{{ route('training_partner.send_for_approval', ['id' => $application_details['id']]) }}">
                        @csrf
                        <input type="hidden" name="approval_value" value="3">
                        <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure, you want to send the application for approval?')">Send For Approval!</button>
                    </form>

                    @elseif($status >= 3)
                    <button type="button" class="btn btn-success" id="sent_for_approval">Sent For Approval!</button>
                    @endif

                    @if($status >= 99)
                    <button type="button" id="forwarded_for_physical_verification" class="btn btn-warning">Physically Verified!</button>
                    @endif
                </div>


                <div class="card-body d-flex justify-content-between">
                    @if(($land_document == 'no_document_path') && ($status >1))
                    Land Document Not Uploaded!
                    @elseif($land_document == 'no_document_path')
                    <form method="POST" action="{{ route('training_partner.upload_land_documents', ['id' => $application_details['id']]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="upload_land_document" class="form-label">Upload Additional Land Document (PDF only)</label>
                            <input type="file" class="form-control-file" name="land_document" id="upload_land_document" accept=".pdf">
                            @error('land_document')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span id="file_size_error" class="text-danger" style="display:none;">File size must be less than 5 MB.</span>
                        </div>

                        <button id="upload_land_document_button" class="btn btn-secondary" type="submit">Upload Land Document</button>
                    </form>
                    @else
                    @if (isset($land_document) && Storage::disk('public')->exists($land_document))
                    <a href="{{ asset('storage/' . $land_document) }}" download>
                        Download Land Document
                    </a>
                    @endif
                    @endif

                    <div class="mb-3">
                        @if($land_image == 'no_image_path' && ($status >1))
                        Land Image Not Uploaded!
                        @elseif($land_image == 'no_image_path')
                        <form method="POST" action="{{ route('training_partner.upload_land_images', ['id' => $application_details['id']]) }}" enctype="multipart/form-data">
                            @csrf
                            <label for="land_image" class="form-label">Upload Land Image (JPEG, PNG, GIF, etc.) <span class="text-danger">*</span></label>
                            <input type="file" class="form-control-file" name="land_image" id="upload_land_image" accept="image/*">
                            @error('land_image')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span id="file_size_error" class="text-danger" style="display:none;">File size must be less than 5 MB.</span>
                            <button id="upload_land_image_button" class="btn btn-secondary" type="submit">Upload Land Image</button>
                        </form>
                        @else
                        @if (isset($land_image) && Storage::disk('public')->exists($land_image))
                        <a href="{{ asset('storage/' . $land_image) }}" download>
                            Download Land Image
                        </a>
                        @endif
                        @endif
                    </div>


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
        function printApplication() {
            window.print();
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#physically_verify_button_when_image_not_uploaded').prop('disabled', true);
            $('#upload_land_document_button').prop('disabled', true);
            $('#upload_land_image_button').prop('disabled', true);
            $('#sent_for_approval').prop('disabled', true);


            $('#forwarded_for_physical_verification').prop('disabled', true);
            $('#approved_and_forwarded_to_training_vendor_for_plantation').prop('disabled', true);


            $('#upload_pri').change(function() {
                var fileSize = this.files[0].size; // in bytes
                var maxSize = 5 * 1024 * 1024; // 5 MB

                if (fileSize > maxSize) {
                    $('#file_size_error').show();
                    $(this).val(''); // Clear the file input
                } else {
                    $('#file_size_error').hide();
                    $('#approve').prop('disabled', false);

                }
            });



            // let block = '{{ addslashes($application_details['
            // block ']) }}';

            let block = '{{ addslashes($application_details['
            block ']) }}';
            let selcted_ward_gp_vc = '{{ addslashes($application_details['
            ward_gp_vc ']) }}';

            // alert(selcted_ward_gp_vc);


            $.ajax({
                url: '/all-wards-gp-vc',
                type: 'GET',
                data: {
                    block: block,
                },
                success: function(data) {
                    let values_to_exclude = ['Select Ward', selcted_ward_gp_vc];


                    $.each(data, function(index, value) {
                        if (values_to_exclude.indexOf(value) === -1) {
                            $('#ward_gp_vc').append('<option value="' + value + '">' + value + '</option>');
                        }
                    });
                }
            });

            $('#upload_land_document').change(function() {
                var fileSize = this.files[0].size; // in bytes
                var maxSize = 5 * 1024 * 1024; // 5 MB

                if (fileSize > maxSize) {
                    $('#file_size_error').show();
                    $(this).val(''); // Clear the file input
                } else {
                    $('#file_size_error').hide();
                    $('#upload_land_document_button').prop('disabled', false);
                }
            });

            $('#upload_land_image').change(function() {
                var fileSize = this.files[0].size; // in bytes
                var maxSize = 5 * 1024 * 1024; // 5 MB

                if (fileSize > maxSize) {
                    $('#file_size_error').show();
                    $(this).val(''); // Clear the file input
                } else {
                    $('#file_size_error').hide();
                    $('#upload_land_image_button').prop('disabled', false);
                }
            });



        });

        function confirm_submit() {
            let confirm_result = confirm("Are you sure you want to change the address and land details?");
            return confirm_result;
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get location as soon as the page loads
            getLocation();
        });

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            document.getElementById("latitude").value = position.coords.latitude;
            document.getElementById("longitude").value = position.coords.longitude;
            // Optionally, you can submit the form automatically after getting the location
            document.forms["registrationForm"].submit();
        }
    </script>


</body>

</html>
