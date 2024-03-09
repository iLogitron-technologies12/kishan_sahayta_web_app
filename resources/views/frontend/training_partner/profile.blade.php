@extends('frontend.training_partner_layout.main')
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
            <!-- <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Submitted Applications</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right"> -->
                        <!-- <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manage Applications</li> -->
                        <!-- <li class="breadcrumb-item active"><a href="/training-partner/submitted-applications"> Relaod Table </a></li>
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
            </div> -->
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">



                    <div class="card">
                        <div class="card-header">
                     

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <h1>Hello World</h1>
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

<!-- <script>
    $(document).ready(function() {

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
    });
</script> -->
@endsection
