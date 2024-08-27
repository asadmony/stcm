@extends('layouts.app')

@section('content')
<div class="container px-0">

    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Select Traffic Point</h3>
                </div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{ route('admin.shiftSlots.show') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <!-- form start -->
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
                    <select class="custom-select form-control-border" id="thana" name="thana_id" onchange="getZone(this.value)">
                        <option value="" disabled selected="true">Select district first</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="zone">Select Traffic Zone </label>
                    <select class="custom-select form-control-border" id="zone" name="zone_id" onchange="getPoint(this.value)">
                        <option value="" disabled selected="true">Select thana first</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="traffic_points">Select Traffic Point </label>
                    <select class="custom-select form-control-border" id="traffic_points" name="traffic_point_id">
                        <option value="" disabled selected="true">Select zone first</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-arrow-alt-circle-right fa-lg"></i>
                    </button>
                </div>
            </form>
            </div>
        </div>
        <div class="col-lg-8">

            <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title success">Update Shifts For Selected Traffic Point</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    @if(isset($selectedDistrict) && isset($selectedThana) && isset($selectedZone) && isset($selectedPoint))
                    <div class="table-responsive bg-cyan">
                        <table class="table m-0">
                            <tr>
                                <th>District</th>
                                <th>:</th>
                                <td>{{ $selectedDistrict->name }}</td>
                            </tr>
                            <tr>
                                <th>Thana</th>
                                <th>:</th>
                                <td>{{ $selectedThana->name }}</td>
                            </tr>
                            <tr>
                                <th>Traffic Zone</th>
                                <th>:</th>
                                <td>{{ $selectedZone->name }}</td>
                            </tr>
                            <tr>
                                <th>Traffic Point</th>
                                <th>:</th>
                                <td>{{ $selectedPoint->name }}</td>
                            </tr>
                        </table>
                    </div>
                    @endif
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Shift</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th style="width: 150px">Number of slots</th>
                        <th>Status</th>
                        {{-- <th style="width: 40px">Options</th> --}}
                      </tr>
                    </thead>
                    <tbody>
                        @if (isset($shiftSlots) && $shiftSlots->count() > 0)
                        @foreach ($shiftSlots as $slot)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $slot->shift->name }}</td>
                            <td>{{ $slot->start_time }}</td>
                            <td>{{ $slot->end_time }}</td>
                            <td>
                                <form class="" id="update-slot-{{ $slot->id }}" action="" method="post">
                                    @csrf
                                    <div class="input-group mb-3 ">
                                        <input type="number" class="form-control" name="slots" value="{{ $slot->slots }}" id="slots-{{ $slot->id }}">
                                        <div class="input-group-append">
                                            <button class="input-group-text" onclick="event.preventDefault();updateSlot('{{ $slot->id }}');"><i class="fas fa-save fa-lg"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td class="" id="status-data-{{ $slot->id }}">
                                @if ($slot->active == 1)
                                    <span class="border rounded px-2 text-success">Active</span>
                                    <a title="make inactive" href="#" class="text-danger" onclick="event.preventDefault();updateStatus({{ $slot->id }})" ><i class="fas fa-lock"></i></a>
                                @else
                                    <span class="border rounded px-2 text-danger">Inactive</span>
                                    <a title="make active" href="#" class="text-primary" onclick="event.preventDefault();updateStatus({{ $slot->id }})" ><i class="fas fa-lock-open"></i></a>
                                @endif
                            </td>
                            {{-- <td>
                                <a href="{{ route('admin.shiftSlots', $slot->id) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                            </td> --}}
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7">
                                <p class="text-center">First select a traffic point</p>
                            </td>
                        </tr>
                        @endif

                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    <script>
        function updateSlot(id){
            const form = document.querySelector('#update-slot-'+id);
            $.ajax({
                type: "post",
                // url: window.location.hostname+"/admin/get-thanas-by-district/"+id,
                url: "/admin/zone-shift-slots/"+id+"/update",
                data: {
                    '_token': form['_token'].value,
                    'slots': form['slots'].value,
                }
            }).done(function(response){
                alert('Slots updated !');
            }).fail(function(response){
                alert('Slots can not be updated !');
                console.log(response);
            });
        }
        function updateStatus(id){
            $.ajax({
                type: "get",
                url: "/admin/zone-shift-slots/"+id+"/updateStatus",
                data: {
                    // 'id': id,
                }
            }).done(function(response){
                if (response == 1) {
                    $('#status-data-'+id).html('<span class="border rounded px-2 text-success">Active</span><a href="#" class="text-danger" onclick="event.preventDefault();updateStatus('+id+')" ><i class="fas fa-lock"></i></a>');
                } else {
                    $('#status-data-'+id).html('<span class="border rounded px-2 text-danger">Inactive</span><a href="#" class="text-primary" onclick="event.preventDefault();updateStatus('+id+')" ><i class="fas fa-lock-open"></i></a>');
                }
            }).fail(function(response){
                alert('Error! Status cannot be updated.');
                console.log(response);
            });
        }
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
                $('#zone').html('<option value="" disabled selected="true">Select Thana first</option>');
                $('#traffic_points').html('<option value="" disabled selected="true">Select Zone first</option>');
                if (response.length > 0) {
                    $('#thana').append('<option value="" disabled selected="true">Select thana</option>');
                    i= 0;
                    while (i < response.length) {
                        $('#thana').append('<option value="'+response[i].id+'"">'+response[i].name+'</option>');
                        i++;
                    }
                }else{
                    $('#thana').append('<option value="" disabled selected="true">No thana found</option>');
                }
            }).fail(function(response){
                console.log(response);
            });
        }
        function getZone(id){
            $.ajax({
                type: "get",
                // url: window.location.hostname+"/admin/get-thanas-by-district/"+id,
                url: "/admin/get-zones-by-thana/"+id,
                data: {
                    // 'district_id': id,
                }
            }).done(function(response){
                $('#zone').html('<option value="" disabled selected="true">Select Traffic Zone</option>');
                $('#traffic_points').html('<option value="" disabled selected="true">Select Zone first</option>');
                if (response.length > 0) {
                    i= 0;
                    while (i < response.length) {
                        $('#zone').append('<option value="'+response[i].id+'">'+response[i].name+'</option>');
                        i++;
                    }
                }else{
                    $('#zone').append('<option value="" disabled selected="true">No zone found</option>');
                }
            }).fail(function(response){
                console.log(response);
            });
        }
        function getPoint(id){
            $.ajax({
                type: "get",
                // url: window.location.hostname+"/admin/get-thanas-by-district/"+id,
                url: "/admin/get-points-by-zone/"+id,
                data: {
                    // 'district_id': id,
                }
            }).done(function(response){
                $('#traffic_points').html('<option value="" disabled selected="true">Select Traffic Point</option>');
                if (response.length > 0) {
                    i= 0;
                    while (i < response.length) {
                        $('#traffic_points').append('<option value="'+response[i].id+'">'+response[i].name+'</option>');
                        i++;
                    }
                }else{
                    $('#traffic_points').append('<option value="" disabled selected="true">No point found</option>');
                }
            }).fail(function(response){
                console.log(response);
            });
        }
    </script>

</div>



@endsection
