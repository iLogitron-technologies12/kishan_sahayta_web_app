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

                        <strong>ration NUMBER:</strong> {{$application_details['ration_no']}} <br>

                        <strong>DOWNLAOD ration:</strong>

                        <a href="{{ asset('storage/' . $application_details['ration_card_image_path']) }}" download>
                            Download ration Card Image
                        </a>
                    </div>


                    <div class="alert alert-secondary">
                        <strong>DISTRICT:</strong> {{$application_details['district']}} <br>

                        <strong>SUB DIVISION(Agri/Horti):</strong> {{$application_details['sub_division']}} <br>

                        <strong>BLOCK:</strong> {{$application_details['block']}} <br>
                        <strong id="block">Bank Name:</strong> {{$application_details['bank_name']}}<br>
                        <strong id="block">Beneficiary Name:</strong> {{$application_details['beneficiary_name']}}<br>
                        <strong id="block">Account Number:</strong> {{$application_details['account_number']}}<br>
                        <strong id="block">IFSC Code:</strong> {{$application_details['ifsc_code']}}<br>

                        <!-- <strong>WARD/GP/VC:</strong> {{$application_details['ward_gp_vc']}} <br> -->

                        <strong>COMPLETE ADDRESS:</strong> {{$application_details['complete_address']}} <br>

                        @if(isset($application_details['ttaadc_area']) && $application_details['ttaadc_area'] == 'TTAADC AREA')
                        <strong>TTAADC AREA:</strong> Yes <br>
                        @else
                        <strong>TTAADC AREA:</strong> No <br>
                        @endif

                    </div>

                    <div class="alert alert-warning">
                        <strong>LAND TYPE :</strong> {{$application_details['land_type']}} <br>
                        <strong>Area(in kani) :</strong> {{$application_details['farming_area_in_acre']}} <br>
                        @if($coordinates != 'not_exists')
                        <strong>GIS Location :</strong> <a href="https://www.google.com/maps/dir/?api=1&destination={{  $coordinates->latitude  }},{{ $coordinates->longitude }}" target="_blank">Get Directions </a>
                        @else
                        <strong>GIS Location :</strong> Not Physically Verified Yet!
                        @endif
                    </div>

                    <div class="alert alert-danger">
                        <strong>APPLIED DATE & TIME:</strong> {{$application_details['updated_at']}}
                    </div>

                    <div class="alert alert-primary">
                    <strong>STATUS OF THE APPLICATION:</strong>
                        @if($application_details['status'] == 1)
                        <td>Submitted by Applicant</td>
                        @elseif($application_details['status'] == 2)
                        <td>Physically Vaerified</td>
                        @elseif($application_details['status'] == 3)
                        <td>Sent for Approval</td>
                        @elseif($application_details['status'] == 4)
                        <td>Approved for Plantation</td>
                        @elseif($application_details['status'] == 5)
                        <td>Application Rejected</td>
                        @elseif($application_details['status'] == 6)
                        <td>Applicant Enrolled For Training</td>
                        @elseif($application_details['status'] == 7)
                        <td>Training Complated</td>
                        @elseif($application_details['status'] == 8)
                        <td>Plant's Alloted</td>
                        @else
                        <td>...</td>
                        @endif
                    </div>


                </div>

                <div class="card-body d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" onclick="window.open('/print-application/{{ $application_details['id'] }}', '_blank')">Print Application</button>

                    @if($pri_sheet_path !== 'not_exists')
                    <a href="{{ asset('storage/' . $pri_sheet_path) }}" download>
                        Download PRI Approval
                    </a>
                    @endif

                    @if($image_path !== 'not_exists')
                    <a href="{{ asset('storage/' . $image_path) }}" download>
                        Download Land Photo
                    </a>
                    @endif

                    @if($land_document_path !== 'not_exists')
                    <a href="{{ asset('storage/' . $land_document_path) }}" download>
                        Download Land Document
                    </a>
                    @endif

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
                // $('#approve').prop('disabled', true);
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

            });
        </script>


</body>

</html>
