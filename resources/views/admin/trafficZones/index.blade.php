@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add New Traffic Zone</h3>
                </div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <!-- form start -->
                <form action="{{ route('admin.zones.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="card-body">
                    <x-alert />

                  <div class="form-group">
                    <label for="district">Select District </label>
                    <select class="custom-select form-control-border" id="district" name="district_id" onchange="getThana(this.value)">
                        <option value="" disabled selected="true">Select district</option>
                        @foreach ($districts as $district)
                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="thana">Select Thanas </label>
                    <select class="custom-select form-control-border" id="thana" name="thana_id">
                        <option value="" disabled selected="true">Select district first</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="name">Traffic Zone Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Traffic Zone name">
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
                  <h3 class="card-title success">Traffic Zone List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Thana</th>
                        <th>District</th>
                        <th>Total Traffic Points</th>
                        <th style="width: 40px">Options</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($zones as $zone)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $zone->name }}</td>
                            <td>{{ $zone->thana->name ?? '' }}</td>
                            <td>{{ $zone->thana->district->name ?? '' }}</td>
                            <td>
                              {{ $zone->trafficPoints->count() }}
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
    <script>
        function getThana(id){
            $.ajax({
                type: "get",
                // url: window.location.hostname+"/admin/get-thanas-by-district/"+id,
                url: "/admin/get-thanas-by-district/"+id,
                data: {
                    // 'district_id': id,
                }
            }).done(function(response){
                $('#thana').html('');
                if (response.length > 0) {
                    i= 0;
                    while (i < response.length) {
                        $('#thana').append('<option value="'+response[i].id+'">'+response[i].name+'</option>');
                        i++;
                    }
                }else{
                    $('#thana').append('<option value="" disabled selected="true">No thana found</option>');
                }
            }).fail(function(response){
                console.log(response);
            });
            }
    </script>

</div>



@endsection
