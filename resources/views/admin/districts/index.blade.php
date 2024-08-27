@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add New District</h3>
                </div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <!-- form start -->
                <form action="{{ route('admin.districts.store') }}" method="POST" enctype="multipart/form-data">

                <div class="card-body">
                    <x-alert />

                    @csrf
                  <div class="form-group">
                    <label for="name">District Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter district name">
                  </div>
                  {{-- <div class="form-group">
                    <label for="name_bn">District Name Bangla</label>
                    <input type="text" class="form-control" id="name_bn" name="name_bn" placeholder="Enter district name bangla">
                  </div> --}}
                  {{-- <div class="form-group">
                    <label for="logo">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="logo">
                        <label class="custom-file-label" for="logo">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div> --}}
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            </div>
        </div>
        <div class="col-md-6">

            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title success">District List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Total thana</th>
                        <th style="width: 40px">Options</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($districts as $district)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $district->name }}</td>
                            <td>
                              {{ $district->thanas->count() }}
                            </td>
                            <td></td>
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
