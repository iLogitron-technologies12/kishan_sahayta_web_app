@extends('frontend.layouts.main')
@section('main-container')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Manegment Bottles</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Manage Bottles</li>
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
              <h3 class="card-title">Demo Title</h3>
            </div>
            <!-- /.card-header -->



            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="#">

              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Enter bottle size in ml</label>
                  <div style="">
                    <div style="width: 70%; float: left; padding-right: 10px;">
                      <input type="number" class="form-control" name="ml" placeholder="e.g.- 100, 1000, 750 etc">
                    </div>
                    <div style="width: 30%; float: left;">
                      <input type="text" class="form-control" id="exampleInputEmail1" value="ml" readonly>
                    </div>
                  </div>
                </div>

                </br>
                </br>
                <div class="form-group">
                  <label for="exampleInputPassword1">Liquor Type</label>
                  <select class="custom-select rounded-0" name="liquor">

                      <option value="#">Option 1</option>
                      <option value="#">Option 2</option>
                      <option value="#">Option 3</option>

                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Brand Name</label>
                  <select class="custom-select rounded-0" name="brand">
                    <option value="#">Option 1</option>
                      <option value="#">Option 2</option>
                      <option value="#">Option 3</option>
                  </select>
                </div>


                <div class="form-group">
                  <label for="exampleInputEmail1">Price Per Bottle</label>
                  <input type="number" class="form-control" id="price" name="price" placeholder="e.g.- 481, 1028.9, 789 etc">
                </div>


                <div class="form-group">
                  <label for="exampleInputEmail1">No. of Bottle per Crate/Casket</label>
                  <input type="number" class="form-control" id="percrate" name="percrate" placeholder="e.g.- 24, 18, 10 etc" onkeypress="setcrateprice()" onblur="setcrateprice()">
                </div>



                <div class="form-group">
                  <label for="exampleInputEmail1">Price Per Crate/Casket/Bundle</label>
                  <input type="text" class="form-control" id="crateprice" name="crateprice" placeholder="e.g.- 24, 18, 10 etc" readonly />
                </div>

              </div>
              <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>


          </div>


          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Bottle Details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>ML</th>
                    <th>Liquor Type</th>
                    <th>Price</th>
                    <th>Brand</th>
                    <th>Per Bundle</th>
                    <th>Bundle Price</th>
                    <th>Bundle Qnty</th>
                    <th>Updated at</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>

                    <tr>

                      <td>1</td>
                      <td>Demo ML </td>
                      <td>Demo Type</td>
                      <td>Demo Price</td>
                      <td>Demo rand</td>
                      <td>Demo Bundle</td>
                      <td>Bundle Price</td>
                      <td>Demo Qnty</td>
                      <td>Date</td>
                      <td>Demo Status</td>

                    </tr>
                     <tr>

                      <td>2</td>
                      <td>Demo ML </td>
                      <td>Demo Type</td>
                      <td>Demo Price</td>
                      <td>Demo rand</td>
                      <td>Demo Bundle</td>
                      <td>Bundle Price</td>
                      <td>Demo Qnty</td>
                      <td>Date</td>
                      <td>Demo Status</td>

                    </tr>
                     <tr>

                      <td>3</td>
                      <td>Demo ML </td>
                      <td>Demo Type</td>
                      <td>Demo Price</td>
                      <td>Demo rand</td>
                      <td>Demo Bundle</td>
                      <td>Bundle Price</td>
                      <td>Demo Qnty</td>
                      <td>Date</td>
                      <td>Demo Status</td>

                    </tr>
                    <tr>

                      <td>4</td>
                      <td>Demo 4 ML </td>
                      <td>Demo 4 Type</td>
                      <td>Demo 4 Price</td>
                      <td>Demo 4 rand</td>
                      <td>Demo 4 Bundle</td>
                      <td>Bundle 4 Price</td>
                      <td>Demo 4 Qnty</td>
                      <td>Date 4</td>
                      <td>Demo Status</td>

                    </tr>

                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>ML</th>
                    <th>Liquor Type</th>
                    <th>Price</th>
                    <th>Brand</th>
                    <th>Per Bundle</th>
                    <th>Bundle Price</th>
                    <th>Bundle Qnty</th>
                    <th>Updated at</th>
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
@endsection
