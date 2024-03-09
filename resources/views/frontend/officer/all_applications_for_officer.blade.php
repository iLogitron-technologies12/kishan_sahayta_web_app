@extends('frontend.layouts.main')
@section('main-container')

<style>
    .card-body {
        max-height: auto !important;
        overflow-y: scroll !important;
    }

    .filter-form {
        margin-left: 30px;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Applications</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manage Applications</li> -->
                        <li class="breadcrumb-item active"><a href="/officer/dashboard"> Relaod Table </a></li>
                    </ol>
                </div>
                @if(isset($success_message))
                <div class="alert alert-success">
                    {{ $success_message }}
                </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger" style="margin-top:10px;">
                    {{ session('error') }}
                </div>
                @endif
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">



                    <div class="card">
                        <div class="card-header">
                            <form method="post" action="{{ route('officer.application_filter') }}">
                                @csrf
                                <span>
                                    Sub Division(Agri/Horti):
                                    <select name="sub_division">
                                        <option value="{{ $sub_division }}">{{ $sub_division }}</option>
                                    </select>
                                </span>

                                <span class="filter-form">
                                    Block:
                                    <select name="block" id="block">
                                        <option value="Select Block">Select Block</option>
                                        @foreach($blocks as $block)
                                        <option value="{{ $block->ulb }}">{{ $block->ulb }}</option>
                                        @endforeach
                                    </select>
                                </span>

                                <!-- <span class="filter-form">
                                    Ward/GP/VC:
                                    <select name="ward_gp_vc" id="ward_gp_vc">
                                        <option value="Select Ward/GP/VC">Select Ward/GP/VC</option>
                                        <option value=""></option>
                                    </select>
                                </span> -->

                                <span class="filter-form">
                                    <button type="submit" style="background-color: #343a40; color: white; border-radius: 15px;">Show Applications</button>
                                </span>
                            </form>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Application Number </th>
                                        <th>Applicant Name</th>
                                        <th>Block</th>
                                        <!-- <th>Ward/GP/VC</th> -->
                                        <th>Area(in Kani)</th>
                                        <th>Gender</th>
                                        <th>Status</th>
                                        <th>View Appl.</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($all_applications as $index => $application)
                                    <tr>
                                        <td>{{ $application['id'] }}</td>
                                        <td>{{ $application['application_id'] }}</td>
                                        <td>{{ $application['name_of_applicant'] }}</td>
                                        <td>{{ $application['block'] }}</td>
                                        <!-- <td>{{ $application['ward_gp_vc'] }}</td> -->
                                        <td>{{ $application['farming_area_in_acre'] }}</td>
                                        <td>{{$application['gender'] }}</td>

                                        @if($application['status'] == 1)
                                        <td>Submitted by Applicant</td>

                                        @elseif($application['status'] == 2)
                                        <td>Physically Verified</td>

                                        @elseif($application['status'] == 3)
                                        <td>Sent for Approval</td>

                                        @elseif($application['status'] == 4)
                                        <td>Approved for Plantation</td>
                                        @elseif($application['status'] == 5)
                                        <td>Application Rejected</td>
                                        @elseif($application['status'] == 6)
                                          <td>Applicant Enrolled For Training</td>
                                        @elseif($application['status'] == 7)
                                         <td>Training Completed</td>
                                        @elseif($application['status'] == 8)
                                           <td>Plant's Alloted</td>

                                        @else
                                        <td>...</td>
                                        @endif

                                        <!-- <td><button type="button">View Application</button></td> -->
                                        <td><button type="button" style="background-color:#007bff21;" target="_blank" onclick="window.location.href='/officer/view-application-approve/{{ $application['id'] }}'">View Application</button></td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>


<script>
    $(document).ready(function() {

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
    });
</script>
@endsection
