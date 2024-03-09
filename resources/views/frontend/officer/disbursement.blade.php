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
                    <h1>Plants Disbursing</h1>
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
              <h3 class="card-title">Disbursement</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{ route('officer.save_disbursement',['id' => $application_details->id])}}">
            @csrf
              <div class="card-body">
                <div class="form-group">
                <div class="row">
                    <div class="col-6">
                      <label for="number_of_plants">Total Number of Plants</label>
                      <input type="number" class="form-control" id="number_of_plants"  name="plant_nos" placeholder="Total Number of Plants for Cultivation" required>
                    </div>
                    <div class="col-6">
                      <label for="disbursed_date">Disbursed Date</label>
                      <input type="date" class="form-control" id="disbursed_date"  name="disbursed_date" required>
                    </div>
                 </div>
                </div>  
                <div class="form-group">
                  <div class="row">
                    <div class="col-6">
                  <label for="area_of_cultivation">Area For Cultivation(Kani)</label>
                  <input type="number" class="form-control" id="area_of_cultivation" name="cultivation_area" placeholder="Area for Cultivation" required>
                  <p id="area_error" class="text-danger"></p>
                </div>
                <div class="col-6">
                  <label for="left_area">Total Left Area For Cultivation</label>
                  <input type="number" class="form-control" id="left_area" name="cultivation_area" disabled>
                </div>
              </div> 
            </div> 
               
                <div class="card-footer">
                  <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
          </div>

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Disbursement List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Number of Plants</th>
                    <th>Area</th>
                    <th>Date</th> 
                  </tr>
                </thead>
                <tbody>
                @foreach($disbursement_details as $index => $disbursement)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $disbursement-> number_of_plants }}</td>
                      <td>{{ $disbursement-> disbursed_area }}</td>
                      <td>{{ $disbursement-> disbursed_date }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Number of Plants</th>
                    <th>Area</th>
                    <th>Date</th>
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
        function leftArea() {
            var totalArea = "{{$application_details['farming_area_in_acre']}}";
            var total = "{{$totalAreaValue}}";
            var leftArea = parseFloat(totalArea) - parseFloat(total);
            $("#left_area").val(leftArea);
        };
        leftArea();
        $("#area_of_cultivation").keyup(function(){
            var inputData = parseFloat($(this).val()); // Corrected the reference to input value
            var totalLeftValue = parseFloat($("#left_area").val());
            if(inputData >totalLeftValue){
              $("#area_error").fadeIn();
              $("#area_error").html("Area for cultivation should be less than remaining Area");
              $("#submit").prop('disabled', true);
            } else {
              $("#area_error").fadeOut();
              $("#submit").prop('disabled', false);
            }
           
        });
    });
</script>

@endsection
