@extends('frontend.super_admin_layouts.main')
@section('main-container')

<style>
    .card-body {
        max-height: auto !important;
        overflow-y: scroll !important;
    }

    .filter-form {
        margin-left: 30px;
    }

    .name-link {
        font-weight: 500;
    }

    .card-body {
        overflow-y: hidden !important;
    }

    .badge {
        font-size: 93%;
    }

    .fw-400 {
        font-weight: 400;
    }

    tbody td.title {
        font-weight: 500;
    }

    .add-agri-expert {
        font-weight: 600 !important;
    }

    .delete-text {
        color: red;
    }

    .delete-text:hover {
        cursor: pointer;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="add-agri-expert">Manage Agri Experts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manage Applications</li> -->
                        {{-- <li class="breadcrumb-item active"><a href="/officer/dashboard"> Relaod Table </a></li> --}}

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
            <div class="row">

                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>

                            <p>Total Agri Experts</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                    </div>
                </div>


                <!-- ./col -->
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px"></sup></h3>

                            <p>Total Active Agri Experts</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                    </div>
                </div>


                <!-- ./col -->
                <div class="col-lg-4 col-12">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Total Inactive Agri Experts</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                    </div>
                </div>



                <!-- ./col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    {{--
                    @if($all_users)
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Manage Training Batch</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                    </div>

                    @endif
                    --}}


                    <div class="card">

                        <!-- <div class="card-header"> -->
                        <!-- <h3 class="card-title">Training Batches</h3> -->
                        <!-- </div> -->
                        <!-- /.card-header -->

                        <div class="card-body">
                            <!-- <table id="example1" class="table table-bordered table-striped"> -->
                            <div class="table-responsive">
                                <table id="example1" class="table ">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="fw-400">#</th>
                                            <th>Agri Expert Name</th>
                                            <th>Designation</th>
                                            <th>Email Id</th>
                                            <th>Mobile Number</th>
                                            <th>Account Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($all_users as $index => $user)
                                        <tr>
                                            <td class="text-center fw-400">{{ $index + 1 }}</td>
                                            <td class="text-center title"><a href="manage-agri-experts/edit-user/{{$user->id}}" target="_blank" class="name-link"> {{ $user->name }} </a></td>

                                            <td class="text-center fw-400">{{ $user->designation }}</td>
                                            <td class="text-center fw-400">{{ $user->email }}</td>
                                            <td class="text-center fw-400">{{ $user->mobile_no }}</td>
                                            @if ( $user->account_status == 1 )
                                            <td class="text-center fw-400"><span class="badge badge-success">Activated</span></td>
                                            @else
                                            <td class="text-center fw-400"><span class="badge badge-danger">Deactivated</span></td>
                                            @endif
                                            <td class="text-center fw-400 delete-text openDeleteConfirmationModal" data-user-id="{{$user->id}}">Delete</td>

                                            <!-- Modal which will get opened on clicking -->
                                            <div class="modal fade" id="deleteConfirmationModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel{{$user->id}}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteConfirmationModalLabel{{$user->id}}">Delete Confirmation</h5>

                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Modal content goes here -->
                                                            Are you sure you want to this Agri Expert?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn hideDeleteConfirmationModal" data-dismiss="modal" data-user-id="{{$user->id}}">Cancel</button>

                                                            <!-- Form for sending the id to server side -->
                                                            <form method="post" action="{{ route('super_admin.delete_agri_expert')}}">
                                                                @csrf
                                                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                                                <button type="submit" class="btn btn-danger deleteConfirmationButton" data-dismiss="modal" data-user-id="{{$user->id}}">Delete</button>
                                                            </form>
                                                            <!-- Form for sending the id to server side ends here -->

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal ends here -->

                                            <form method="POST" action="{{ route('super_admin.delete_agri_expert',['id' =>$user->id])}}">
                                                @csrf
                                                <input type="hidden" name="training_applicant" value="{{ $user->id }}">


                                                {{--
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-success" style="width:100%;" onclick="return confirm('Mark training has completed!!')"@if($batch->status =="2") disabled @endif>
                            @if($user->status =="1") Active
                            @else
                            Inactive
                            @endif
                          </button>
                        </div>
                        --}}
                                            </form>

                                            </td>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                    <tfoot>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>Agri Expert Name</th>
                                            <th>Designation</th>
                                            <th>Email Id</th>
                                            <th>Mobile Number</th>
                                            <th>Account Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
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

        $(document).on('click', '.openDeleteConfirmationModal', function() {
            var userId = $(this).data('user-id');
            $('#deleteConfirmationModal' + userId).modal('show');
        });

        $(document).on('click', '.hideDeleteConfirmationModal', function() {
            var userId = $(this).data('user-id');
            console.log(`got a click for userid ${userId}`);
            $('#deleteConfirmationModal' + userId).modal('hide');
        });

        $(document).on('click', '.deleteConfirmationButton', function() {
            var userId = $(this).data('user-id');
            console.log(`got a click for userid ${userId}`);

            // Perform deletion or any other action here using the user ID
        });
    });
</script>
@endsection
