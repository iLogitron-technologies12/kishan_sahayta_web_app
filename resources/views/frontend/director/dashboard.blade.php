@extends('frontend.director_layout.main')
@section('main-container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">

            <!-- DONUT CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Application Status Chart(Total Number)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i> -->
                  </button>
                </div>
              </div>
              <div class="card-body"> 
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">

            <!--################################## Approve Area BAR CHART #################################### -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Approved Area Chart(in Hectare)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i> -->
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
             <!--################################## End Approve Area BAR CHART #################################### -->

            <!-- STACKED BAR CHART -->
            <!-- <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Total Application Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
             
            </div> -->
            <!-- /.card -->
          </div>
          <!-- /.col (RIGHT) -->   
        </div>
        <!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

   


   <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">


          <div class="card">
            <div class="card-header">
              <h3 class="card-title">District wise Applications(Total Number)</h3>
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
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
              <div class="card-body">
                <div class="chart">
                  <canvas id="dateBarChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
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





  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">


         <!-- STACKED BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Training Batches Chart(Total Number)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
             
            </div>
            <!-- /.card -->

          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>




  </div>
  <!-- /.content-wrapper -->
  
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- Page specific script -->
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
    
    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels:{!! json_encode($application_status_name) !!},
      datasets: [
        {
          data: {!! json_encode($application_count) !!},
          backgroundColor : ['#f56954','#296828', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
 

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = {
      labels  : {!! json_encode($area_district_name) !!},
      datasets: [
        {
          label               : 'Approved Farming Area Applications',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : {!! json_encode($approved_area) !!}
        },
        {
          label               : 'Area Under Processing Applications',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : {!! json_encode($processing_area) !!}
        },
        {
          label               : 'Rejected Area Applications',
          backgroundColor     : 'rgba(135, 29, 3, 1)',
          borderColor         : 'rgba(135, 29, 3, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(135, 29, 3, 1)',
          pointStrokeColor    : '#871D03',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : {!! json_encode($rejected_area) !!}
        },
        
      ]
    }

    var barChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })


    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = {
      labels  : {!! json_encode($sub_division_officer) !!},
      datasets: [
        {
          label               : 'Total Batches are Under Training',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : {!! json_encode($enrolled_training) !!}
        },
        {
      label               : 'Total Training Completed Batches',
      backgroundColor     : 'rgba(242, 121, 14,0.9)',
      borderColor         : 'rgba(242, 121, 14,0.8)',
      pointRadius          : false,
      pointColor          : '#ff6384',
      pointStrokeColor    : 'rgba(242, 121, 14,1)',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(242, 121, 14,1)',
      data                : {!! json_encode($training_complated) !!}
    },
   
        
      ]
    }

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })
</script>


<!-- ############################################################################################### -->
<!-- ########################start chart using Ajax for district wise chart ########################-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

<script>
    $(document).ready(function() {
      var dateBarChartCanvas2 = $('#dateBarChart2');
      var dateBarChart;

      // Initial data
      var dateBarChartData2 = {
        labels: {!! json_encode($date_based_district_name) !!},
        datasets: [
          {
            label: 'Applications Pending',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            data: {!! json_encode($date_based_application_submitted) !!}
          },
          {
            label: 'Physically Verified',
            backgroundColor: 'rgba(255,99,132,0.9)',
            borderColor: 'rgba(255,99,132,0.8)',
            data: {!! json_encode($date_based_application_physically_verified) !!}
          },
          {
            label: 'Applications sent for Approval',
            backgroundColor: 'rgba(190, 254, 117,0.9)',
            borderColor: 'rgba(190, 254, 117,0.8)',
            data: {!! json_encode($date_based_application_sent_for_approval) !!}
          },
          {
            label: 'Applications Approved',
            backgroundColor: 'rgba(47, 122, 2 ,0.9)',
            borderColor: 'rgba(47, 122, 2 ,0.8)',
            data: {!! json_encode($date_based_application_approved) !!}
          },
          {
            label: 'Applications Rejected',
            backgroundColor: 'rgba(254, 11, 3,0.9)',
            borderColor: 'rgba(254, 11, 3,0.8)',
            data: {!! json_encode($date_based_application_rejected) !!}
          },
          {
            label: 'Applications enroll for training',
            backgroundColor: 'rgba(254, 121, 117 ,0.9)',
            borderColor: 'rgba(254, 121, 117 ,0.8)',
            data: {!! json_encode($date_based_enroll_for_training) !!}
          },
          {
            label: 'Training Completed Applications',
            backgroundColor: 'rgba(140, 3, 136 ,0.9)',
            borderColor: 'rgba(140, 3, 136 ,0.8)',
            data: {!! json_encode($date_based_training_complete) !!}
          },
          {
            label: ' Applications plant alloted',
            backgroundColor: 'rgba(3, 140, 49 ,0.9)',
            borderColor: 'rgba(3, 140, 49 ,0.8)',
            data: {!! json_encode($date_based_plant_alloted) !!}
          }
        ]
      };

      var dateBarChartOptions2 = {
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

      dateBarChart = new Chart(dateBarChartCanvas2, {
        type: 'bar',
        data: dateBarChartData2,
        options: dateBarChartOptions2
      });

      $('#check').on('click', function(e) {
        e.preventDefault();
        let date = $('#applicationDate').val();
        let category = $('#category').val();

        $.ajax({
          url: '/get-farmer-details-based-on-date',
          type: 'GET',
          data: {
            date: date,
            filterType: category
          },
          success: function(data) {
            let district = data.date_based_district_name;
            let submittedData = data.date_based_application_Pandding;
            let verifiedData = data.date_based_application_physically_verified;
            let sendforapprovedData = data.date_based_application_sent_for_approval;
            let approvedData = data.date_based_application_approved;
            let rejecteddData = data.date_based_application_rejected;
            let enrollData = data.date_based_enroll_for_training;
            let trainingComplateData = data.date_based_training_complete;
            let plantData = data.date_based_plant_alloted;
console.log(submittedData);

            // Update chart data
            dateBarChart.data.labels = district;
            dateBarChart.data.datasets[0].data = submittedData;
            dateBarChart.data.datasets[1].data = verifiedData;
            dateBarChart.data.datasets[2].data = sendforapprovedData;
            dateBarChart.data.datasets[3].data = approvedData;
            dateBarChart.data.datasets[4].data = rejecteddData;

            dateBarChart.data.datasets[5].data = enrollData;
            dateBarChart.data.datasets[6].data = trainingComplateData;
            dateBarChart.data.datasets[7].data = plantData;

            // Update the chart
            dateBarChart.update();
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

@endsection