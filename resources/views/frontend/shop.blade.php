@extends('frontend.layouts.main')
@section('main-container')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Manage Liquor Shop</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Manage Liquor Shop</li>
          </ol>
        </div>
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
              <h3 class="card-title"> Demo Title</h3>
            </div>
            <!-- /.card-header -->



            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="">

              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Shop Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="Enter the name of the Shop">
                </div>
               
                <div class="form-group">
                  <label for="exampleInputPassword1">Select Status</label>
                  <select class="custom-select rounded-0" name="status">
                    <option value="1">Approved</option>

                    <option value="2">Not Approved</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Select Proprietor</label>
                  <select class="custom-select rounded-0" name="pro">
                    <option value="">Select a Proprietor</option>
                    <option value="">Select a Proprietor</option>
                    <option value="">Select a Proprietor</option>
                   
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Select District</label>
                  <select class="custom-select rounded-0" name="dist">

                    <option value="1">West Tripura</option>
                    <option value="2">Dhalai</option>
                    <option value="3">North Tripura</option>
                    <option value="4">South Tripura</option>
                    <option value="5">Unakoti</option>
                    <option value="6">Sipahijala</option>
                    <option value="7">Gomati</option>
                    <option value="8">Khowai</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Postal PIN</label>
                  <input type="number" class="form-control" name="pin" id="exampleInputPassword1" placeholder="E.g.-799001, 799277, 799250 etc">
                </div>


                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>


          </div>


          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Liquor Shop List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Shop Name</th>
                    <th>State</th>
                    <th>District</th>
                    <th>Pin</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Proprietor</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                    <tr>
                      <td>1</td>
                      <td>Demo Name</td>
                      <td>Demo State</td>
                      <td>Demo District </td>
                      <td>Demo pin</td>
                      <td>Demo Status </td>
                      <td>Date</td>
                      <td>Demo Proprietor</td>
                      <td>Action</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Demo Name</td>
                      <td>Demo State</td>
                      <td>Demo District </td>
                      <td>Demo pin</td>
                      <td>Demo Status </td>
                      <td>Date</td>
                      <td>Demo Proprietor</td>
                      <td>Action</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Demo Name</td>
                      <td>Demo State</td>
                      <td>Demo District </td>
                      <td>Demo pin</td>
                      <td>Demo Status </td>
                      <td>Date</td>
                      <td>Demo Proprietor</td>
                      <td>Action</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Demo Name</td>
                      <td>Demo State</td>
                      <td>Demo District </td>
                      <td>Demo pin</td>
                      <td>Demo Status </td>
                      <td>Date</td>
                      <td>Demo Proprietor</td>
                      <td>Action</td>
                    </tr>
                 
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Shop Name</th>
                    <th>State</th>
                    <th>District</th>
                    <th>Pin</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Proprietor</th>
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
<!-- /.content-wrapper -->
@endsection