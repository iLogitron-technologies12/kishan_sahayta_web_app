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


{{--
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

                                <span class="filter-form">
                                    <button type="submit" style="background-color: #343a40; color: white; border-radius: 15px;">Show Applications</button>
                                </span>
                            </form>
                        </div>
--}}
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



@endsection
