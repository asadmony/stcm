@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add New Shift</h3>
                </div>
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <!-- form start -->

              <form action="{{ route('admin.shifts.store') }}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Shift name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter shift name">
                  </div>
                  <div class="form-group">
                    <label for="start">Shift start time</label>
                    <input type="time" class="form-control" id="start" name="start" placeholder="Start time">
                  </div>
                  <div class="form-group">
                    <label for="end">Shift end time</label>
                    <input type="time" class="form-control" id="end" name="end" placeholder="End time">
                  </div>
                  <div class="form-group">
                    <label for="slots">Default Number of slot</label>
                    <input type="number" class="form-control" id="slots" name="slots" value="5">
                  </div>
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
                  <h3 class="card-title success">Traffic Area List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Name</th>
                          <th>Start Time</th>
                          <th>End Time</th>
                          <th>Total Student Slots</th>
                          <th style="width: 40px">Options</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($shifts as $shift)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $shift->name }}</td>
                              <td>{{ $shift->start ?? '' }}</td>
                              <td>{{ $shift->end ?? '' }}</td>
                              <td>
                                {{ $shift->slots }}
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
