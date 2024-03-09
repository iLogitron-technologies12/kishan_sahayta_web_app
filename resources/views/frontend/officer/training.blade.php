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
                    <h1>Training Batch</h1>
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

        @if($application_details)
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Manage Training Batch</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            
            <form method="post" action="{{ route('officer.save-training')}}">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="batch">Training Batch Name<span style="color:red;">*</span></label>
                  <input type="text" required class="form-control" id="batch" name="batch" placeholder="Enter the Name of Training Batch">
                </div>   
                <div class="form-group">
                  <p><b>Applicant for Training</b><span style="color:red;">*</span></p>
                  @foreach($application_details as $application)
                     
                  <div class="quiz-options">
                  <input type="checkbox" id="{{$application->application_id}}"  name="applicant[]" value="{{$application->id}}">
                  <label for="{{$application->application_id}}">{{$application->name_of_applicant}}||{{$application->application_id}}</label><br>
                  </div>
                   @endforeach
                 
                </div> 
                 <div class="form-group">
                  <label for="start_date">Starting Date of Training<span style="color:red;">*</span></label>
                  <input type="date" class="form-control" id="start_date" required name="start_date">
                </div>
                <div class="form-group">
                  <label for="end_date">Ending Date of Training<span style="color:red;">*</span></label>
                  <input type="date" class="form-control" id="end_date" required name="end_date">
                </div> 
                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary" onclick="return confirm('Are you sure, you want to create this training batch?')">Submit</button>
                </div>
            </form>
          </div>

        @endif


          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Training Batches</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Training Batch Name</th>
                    <th>Applicants Name</th>
                    <th>Starting Date</th>
                    <th>Ending Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($training_batches_details as $index => $batch)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $batch->applicant_batch_name }}</td>
                      <td>
                      {{ $batch->applicants }}
                    </td>
                     
                      <td>{{ $batch->training_start_date }}</td>
                      <td>{{ $batch->training_end_date }}</td>
                      <td>
                      <form method="POST" action="{{ route('officer.approve-training-status',['id' =>$batch->id])}}">
                        @csrf
                        <input type="hidden" name="training_applicant" value="{{ $batch->application_id }}">
                          

                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-success" style="width:100%;" onclick="return confirm('Mark training has completed!!')"@if($batch->status =="2") disabled @endif>
                            @if($batch->status =="1") Active
                            @else
                            Inactive
                            @endif
                          </button>
                        </div>
                    </form>
                    
                    </td>
                    </tr>
                    @endforeach
                    
                 
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Training Batch Name</th>
                    <th>Applicants Name</th>
                    <th>Starting Date</th>
                    <th>Ending Date</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
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
