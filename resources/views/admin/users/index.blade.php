@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add New User Area</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <!-- form start -->

              <form action="" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                    </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label>User Type</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" name="type" value="tc" id="tc">
                        <label for="tc" class="custom-control-label">Traffic Controller</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input custom-control-input-warning" type="radio" name="type" value="ts" id="ts">
                        <label for="ts" class="custom-control-label custom-control-input-warning">Traffic Supervisor</label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer ">
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
                </div>
              </form>
            </div>
        </div>
        <div class="col-md-6">

            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title success">User List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Options</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->type }}</td>
                            <td>
                                <a href="#"><i class="fas fa-info-circle fa-lg px-2"></i></a>
                                <a href="#"><i class="fas fa-edit text-secondary fa-lg px-2"></i></a>
                                <a href="#"><i class="fas fa-trash text-danger fa-lg px-2"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
