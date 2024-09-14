@extends('layouts.mobile')

@section('content')
<div class="screen-wrap">


    <main class="app-content">

    <div class="bg-primary padding-x padding-bottom">
        <h3 class="title-page text-center text-white">{{ config('app.name', 'STCM') }}</h3>
    </div>

    <section class="padding-around">
    <div class="row justify-content-center">
        <x-alert />
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Select your nearest location</h3>
                </div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{ route('shiftSlots.show') }}" method="GET" enctype="multipart/form-data">
                <!-- form start -->
                <div class="card-body">

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
                  <h3 class="card-title success">Book your Shift</h3>
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
                    <div>
                        @if (isset($shiftSlots) && $shiftSlots->count() > 0)
                        <form action="{{ route('bookShift.store') }}" method="POST" id="ele">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-2 col-form-label">Select Date</label>
                                    <div class="col-sm-10">
                                    <input type="date" class="form-control datepicker"  data-date-start-date="+1d" id="date" name="date" value="{{ old('date') ?? '' }}">
                                    </div>
                                </div>
                                <table class="table table-striped-">
                                    <thead>
                                      <tr>
                                        <th style="width: 10px">Select</th>
                                        <th>Shift</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($shiftSlots as $slot)
                                        <tr class="">
                                            <td><input class="" type="checkbox" id="slots-{{ $slot->id }}" name="slots[]" value="{{ $slot->id }}"></td>
                                            <td>{{ $slot->shift->name }}</td>
                                            <td>{{ $slot->start_time }}</td>
                                            <td>{{ $slot->end_time }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                  </table>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary w-100"><i class="far fa-calendar-check"></i> Book</button>
                            </div>
                        </form>
                        @elseif(!isset($shiftSlots))
                            <div class="alert m-3" role="alert">
                                Please select district, thana, zone and traffic point.
                            </div>
                        @else
                            <div class="alert alert-danger m-3" role="alert">
                                We are not hiring for this area yet.
                            </div>
                        @endif
                        </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <script>
        var elem = document
            .getElementById("ele");
        elem
            .scrollIntoView();
    </script>
    <script>
        function getThana(id){
            $.ajax({
                type: "get",
                // url: window.location.hostname+"/admin/get-thanas-by-district/"+id,
                url: "/get-thanas-by-district/"+id,
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
                url: "/get-zones-by-thana/"+id,
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
                url: "/get-points-by-zone/"+id,
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
    </section>

    </main>

    @include('mobile.component.nav-bottom')


    </div>
@endsection
