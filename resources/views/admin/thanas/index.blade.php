@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add New Thana</h3>
                </div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <!-- form start -->
                <form action="{{ route('admin.thanas.store') }}" method="POST" enctype="multipart/form-data">

                <div class="card-body">
                    <x-alert />

                    @csrf
                  <div class="form-group">
                    <label for="district">Select District </label>
                  <select class="custom-select form-control-border" id="district" name="district_id">
                    @foreach ($districts as $district)
                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                    @endforeach
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="name">Thana Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter thana name">
                  </div>
                  {{-- <div class="form-group">
                    <label for="name">Thana Name</label>
                    <input type="text" class="form-control" id="name" name="name_bn" placeholder="Enter thana name bangla">
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
                  <h3 class="card-title success">Thana List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>District</th>
                        <th>Total Traffic Zones</th>
                        <th style="width: 40px">Options</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($thanas as $thana)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $thana->name }}</td>
                            <td>{{ $thana->district->name ?? '' }}</td>
                            <td>
                              {{ $thana->zones->count() }}
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
