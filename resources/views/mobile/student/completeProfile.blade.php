@extends('layouts.mobile')

@section('content')
<div class="screen-wrap">


    <main class="app-content">

    <div class="bg-primary padding-x padding-bottom">
        <h3 class="title-page text-center text-white">{{ config('app.name', 'STCM') }}</h3>
    </div>

    <section class="padding-around">
    <form action="{{ route('completeProfile.store') }}" method="post" class="form-horizontal">
                @csrf
                <div class="card-body">
                    <x-alert />
                    <div class="orm-group text-center pb-2">
                        * All fields are required
                    </div>
                  <div class="form-group row">
                    <label for="father_name" class="col-sm-2 col-form-label">Father's Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="father_name" name="father_name" placeholder="Father's Name" value="{{ old('father_name') ?? '' }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="mother_name" class="col-sm-2 col-form-label">Mother's Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="mother_name" name="mother_name" placeholder="Mother's Name" value="{{ old('mother_name') ?? '' }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="male" name="gender" value="Male">
                            <label for="male" class="custom-control-label">Male</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="female" name="gender" value="Female">
                            <label for="female" class="custom-control-label">Female</label>
                        </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nid" class="col-sm-2 col-form-label">NID no.</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nid" name="nid" placeholder="NID no." value="{{ old('nid') ?? '' }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="mobile" class="col-sm-2 col-form-label">Mobile no.</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="01XXXXXXXXX" value="{{ old('mobile_no') ?? '' }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="address" name="address" placeholder="Your Present Address">{{ old('address') ?? '' }}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="education_institute" class="col-sm-2 col-form-label">Current Education Institute name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="education_institute" name="education_institute" placeholder="Education Institute" value="{{ old('education_institute') ?? '' }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="education_level" class="col-sm-2 col-form-label">Current Education Level</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="education_level" name="education_level" placeholder="Class 10/12/1st Year 2nd Semester" value="{{ old('education_level') ?? '' }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="education_id" class="col-sm-2 col-form-label">Current Education ID</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="education_id" name="education_id" placeholder="Roll no. / Reg. no." value="{{ old('education_id') ?? '' }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="date_of_birth" class="col-sm-2 col-form-label">Date of birth</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') ?? '' }}">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info w-100"><i class="fas fa-save"></i> Save</button>
                </div>
                <!-- /.card-footer -->
              </form>

    </section>

    </main>

    <nav class="nav-bottom">
        <a href="index.html" class="nav-link active">
            <i class="icon fa fa-home"></i><span class="text">Home</span>
        </a>

        <a href="page-category-1.html" class="nav-link">
            <i class="icon fa fa-th"></i><span class="text">Category</span>
        </a>

        <a href="page-cart-1.html" class="nav-link">
            <i class="icon fa fa-shopping-cart"></i><span class="text">Cart</span>
        </a>

        <a href="page-profile.html" class="nav-link">
            <i class="icon fa fa-user"></i><span class="text">Profile</span>
        </a>
    </nav> <!-- nav-bottom -->


    </div>
@endsection
