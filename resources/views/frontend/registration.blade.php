@extends('frontend.layouts.main')
@section('main-container')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Manage Farmer</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Manage Farmer</li>
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
              <h3 class="card-title">Farmer's Registration</h3>
            </div>
            <!-- /.card-header -->



            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{url('/')}}/farmer-registration">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="farmer">Farmer's Name</label>
                  <input type="text" class="form-control" id="farmer" name="name" placeholder="E.g-Ratan Kumar Das, Dilip Debbarma etc">
                  <span class="text-danger">
                    @error('name')
                    {{$message}}
                    @enderror
                  </span>
                </div>
                <div class="form-group">
                  <label for="phone">Phone Number</label>
                  <input type="number" class="form-control" name="phone" id="phone" placeholder="E.g.-7009321290, 9326522341, 9262630809 etc">
                  <span class="text-danger">
                    @error('phone')
                    {{$message}}
                    @enderror
                  </span>
                </div>
              
                <div class="form-group">
                  <label for="father">Father's Name</label>
                  <input type="text" class="form-control" id="father" name="father" placeholder="E.g-Ratan Kumar Das, Dilip Debbarma etc">
                  <span class="text-danger">
                    @error('father')
                    {{$message}}
                    @enderror
                  </span>
                </div>
                <div class="form-group">
                  <label for="field">Field Area</label>
                  <input type="text" class="form-control" id="field" name="area" placeholder="E.g-10 Kani, 100 kani, 50 acre etc">
                  <span class="text-danger">
                    @error('area')
                    {{$message}}
                    @enderror
                  </span>
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
                  <span class="text-danger">
                    @error('dist')
                    {{$message}}
                    @enderror
                  </span>
                </div>
                <div class="form-group">
                  <label for="sub-division">Sub-Division</label>
                  <input type="text" class="form-control" id="sub-division" name="division" placeholder="E.g-sadar,jirania,kumarghat etc">
                  <span class="text-danger">
                    @error('division')
                    {{$message}}
                    @enderror
                  </span>
                </div>
                <div class="form-group">
                  <label for="block">Block</label>
                  <input type="text" class="form-control" id="block" name="block" placeholder="E.g-sadar,jirania,kumarghat etc">
                  <span class="text-danger">
                    @error('block')
                    {{$message}}
                    @enderror
                  </span>
                </div>
                <div class="form-group">
                  <label for="gpvc">GP/VC</label>
                  <input type="text" class="form-control" id="gpvc" name="gpvc" placeholder="E.g-sadar,jirania,kumarghat etc">
                  <span class="text-danger">
                    @error('gpvc')
                    {{$message}}
                    @enderror
                  </span>
                </div>
               
                <div class="form-group">
                  <label for="exampleInputPassword1">Postal PIN</label>
                  <input type="number" class="form-control" name="pin" id="exampleInputPassword1" placeholder="E.g.-799001, 799277, 799250 etc">
                  <span class="text-danger">
                    @error('pin')
                    {{$message}}
                    @enderror
                  </span>
                </div>


                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>


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