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
                    <h1>Dashboard</h1>
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
    
   <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">


          <div class="card">
            <div class="card-header">
              <h3 class="card-title"> Applications Dashboard(Total Number)</h3>
              <form>
              <div class="float-right" style="display:flex;">
              <div class="form-group m-2">
                  <input type="date" class="form-control" id="applicationDate">
                </div> 
                <div class="form-group m-2">
                <select  id="category" class="form-control">
                    <option value="1">Date</option>
                    <option value="2">Month</option>
                    <option value="3">Year</option>
                </select>
                </div> 
                <div class="form-group m-2">
                <button id="check" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </form> 
              </div>
            </div>
            <!-- /.card-header -->
            
                <div class="chart">
                  <canvas id="applicationsBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <!--#################################/.Start Training Pai Chart .##################################\-->
        <div class="col-md-6">
            <!-- PIE CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Training Details Chart(Total Number)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="">
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
          </div>
       <!--#################################/.End Training Pai Chart .##################################\-->
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

<script>
    $(document).ready(function() {
      var applicationBarChartCanvas = $('#applicationsBarChart');
      var applicationBarChart;

      // Initial data
      var applicationBarChartData = {
        labels: {!! json_encode($application_status_name) !!},
        datasets: [
          {
            label: 'Applications Pending',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            data: {!! json_encode($status_based_application_submitted) !!}
          },
          {
            label: 'Physically Verified',
            backgroundColor: 'rgba(255,99,132,0.9)',
            borderColor: 'rgba(255,99,132,0.8)',
            data: {!! json_encode($status_based_application_physically_verified) !!}
          },
          {
            label: 'Applications sent for Approval',
            backgroundColor: 'rgba(190, 254, 117,0.9)',
            borderColor: 'rgba(190, 254, 117,0.8)',
            data: {!! json_encode($status_based_application_sent_for_approval) !!}
          },
          {
            label: 'Applications Approved',
            backgroundColor: 'rgba(47, 122, 2 ,0.9)',
            borderColor: 'rgba(47, 122, 2 ,0.8)',
            data: {!! json_encode($status_based_application_approved) !!}
          },
          {
            label: 'Applications Rejected',
            backgroundColor: 'rgba(254, 11, 3,0.9)',
            borderColor: 'rgba(254, 11, 3,0.8)',
            data: {!! json_encode($status_based_application_rejected) !!}
          },
          {
            label: 'Applications enroll for training',
            backgroundColor: 'rgba(254, 121, 117 ,0.9)',
            borderColor: 'rgba(254, 121, 117 ,0.8)',
            data: {!! json_encode($status_based_enroll_for_training) !!}
          },
          {
            label: 'Training Completed Applications',
            backgroundColor: 'rgba(140, 3, 136 ,0.9)',
            borderColor: 'rgba(140, 3, 136 ,0.8)',
            data: {!! json_encode($status_based_training_complete) !!}
          },
          {
            label: ' Applications plant alloted',
            backgroundColor: 'rgba(3, 140, 49 ,0.9)',
            borderColor: 'rgba(3, 140, 49 ,0.8)',
            data: {!! json_encode($status_based_plant_alloted) !!}
          }
        ]
      };

      var applicationBarChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        scales: {
          x: {
            grid: {
              display: false
            }
          },
          y: {
            grid: {
              display: false
            }
          }
        }
      };

      applicationBarChart = new Chart(applicationBarChartCanvas, {
        type: 'bar',
        data: applicationBarChartData,
        options: applicationBarChartOptions
      });

      $('#check').on('click', function(e) {
        e.preventDefault();
        let date = $('#applicationDate').val();
        let category = $('#category').val();

        $.ajax({
          url: '/get-farmer-all-details-for-officer',
          type: 'GET',
          data: {
            date: date,
            filterType: category
          },
          success: function(data) {
            $("#message").text(data);
             let status = data.application_status_name;
             let submittedData = data.status_based_application_submitted;
             let verifiedData = data.status_based_application_physically_verified;
             let sendforapprovedData = data.status_based_application_sent_for_approval;
             let approvedData = data.status_based_application_approved;
             let rejecteddData = data.status_based_application_rejected;
             let enrollData = data.status_based_enroll_for_training;
             let trainingComplateData = data.status_based_training_complete;
             let plantData = data.status_based_plant_alloted;
//console.log(status);

            //Update chart data
              applicationBarChart.data.labels = status;
              applicationBarChart.data.datasets[0].data = submittedData;
              applicationBarChart.data.datasets[1].data = verifiedData;
              applicationBarChart.data.datasets[2].data = sendforapprovedData;
              applicationBarChart.data.datasets[3].data = approvedData;
              applicationBarChart.data.datasets[4].data = rejecteddData;

              applicationBarChart.data.datasets[5].data = enrollData;
              applicationBarChart.data.datasets[6].data = trainingComplateData;
             applicationBarChart.data.datasets[7].data = plantData;

            // Update the chart
             applicationBarChart.update();
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
      });
    });
  </script>
  <!-- ############################################################################################### -->
<!-- ########################End chart using Ajax for district wise chart ########################-->
<!--##################  ***** start Training Pai chart **** ##################################-->
<script>
  $(function () {
   
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = {
      labels: {!! json_encode($training_batches_status) !!},
      datasets: [
        {
          data: {!! json_encode($training_batches) !!},
          backgroundColor : ['#f56954', '#00a65a'],
        }
      ]
    }
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })
  });
  </script>

@endsection
