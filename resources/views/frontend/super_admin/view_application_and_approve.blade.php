<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Application Form</title>
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
                        <td>Teaining Complated</td>
                        @elseif($application_details['status'] == 8)
                        <td>Plant's Alloted</td>
                        @else
                        <td>...</td>
                        @endif
                    </div>

                    @if(isset($coordinates))
                    <div class="alert alert-success">
                        GIS Location: <a href="https://www.google.com/maps/dir/?api=1&destination={{  $coordinates->latitude  }},{{ $coordinates->longitude }}" target="_blank">Get Directions</a>
                    </div>
                    @endif


                </div>

                <div class="card-body d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" onclick="window.open('/print-application/{{ $application_details['id'] }}', '_blank')">Print Application</button>
                    <!-- @if(($status == 2) || ($status == 3))
                    <form method="POST" action="{{ route('officer.view_application_approve', ['id' => $application_details['id']]) }}">
                        @csrf
                        <input type="hidden" name="approval_value" value="4">
                        <button type="submit" class="btn btn-warning">Forward for Physical Verification</button>
                    </form>
                    @endif

                    @if(($status >= 4) && ($status < 7))
                    <button type="button" id="forwarded_for_physical_verification" class="btn btn-warning">Forwarded for Physical Verification</button>
                    @endif -->
                </div>

                <div class="card-body d-flex justify-content-end">
                    @if($status == 3)
                    <form method="POST" action="{{ route('officer.view_application_approve', ['id' => $application_details['id']]) }}">
                        @csrf
                        <input type="hidden" name="approval_value" value="4">
                        <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure, you want to approve the application?')">Approve for Plantation</button>
                    </form>
                    @endif
                    @if($status == 7)
                    <a id="Disbursement" href="{{ route('officer.view_disbursement', ['id' => $application_details['id']]) }}" class="btn btn-success">Disbursement</a>
                    @endif
                </div>

                <div class="card-body d-flex justify-content-between">
                    @if($status == 3)
                    <form method="POST" action="{{ route('officer.view_application_approve', ['id' => $application_details['id']]) }}" class="row">
                        @csrf
                        <div class="col-md-9">
                        <input type="hidden" name="approval_value" value="5">
                            <textarea name="reason" class="form-control" rows="1" cols="580" placeholder="Write the reason for rejection"></textarea>
                            @error('reason')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 text-right">
                            <button type="submit" class="btn btn-danger" style="width:100%;" onclick="return confirm('Are you sure, you want to reject the application?')">Reject Application</button>
                        </div>
                    </form>
                    @endif
                </div>

                <!-- @if ($id_exists == 1)
                <div class="card-body">
                    PRI Approval Sheet Uploaded
                    @if(isset($pri_approval_sheet_path) && !empty($pri_approval_sheet_path))
                    <a href="{{ asset('storage/' . $pri_approval_sheet_path) }}" download>
                        Download
                    </a>
                    @endif
                </div>
                @else
                <div class="card-body d-flex justify-content-between">
                    <form method="POST" action="{{ route('officer.view_application_approve', ['id' => $application_details['id']]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="upload_pri_approval_sheet" class="form-label">Upload PRI Approval Sheet (PDF only)</label>
                            <input type="file" class="form-control-file" name="pri_approval_sheet" id="pri_approval_sheet" accept=".pdf">
                            @error('pri_approval_sheet')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <span id="file_size_error" class="text-danger" style="display:none;">File size must be less than 5 MB.</span>

                            <br>
                            <input type="radio" name="approval_status" value="approved" checked> Approved
                            <input type="radio" name="approval_status" value="unapproved"> Unapproved

                        </div>

                        <button id="upload_pri" class="btn btn-secondary" type="submit">Upload PRI Approval Sheet</button>

                    </form>
                    @endif
                    @if(isset($reason_for_rejection) && !empty($reason_for_rejection))
                    <div class="alert alert-danger" style="padding:20px;">
                    <span >Rejected:</span>
                       {{ $reason_for_rejection }}
                    </div>
                    @endif
                </div> -->

                <!-- <div class="card-body d-flex justify-content-between">
                    @if($status == 4)
                    <div class="col-md-3 text-right">
                            <a href="" class="btn btn-danger" style="width:100%;">Disbursement</>
                        </div>
                    
                    @endif
                </div> -->


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
