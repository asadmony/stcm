@extends('layouts.mobile')
@section('content')
<div class="screen-wrap">
    <main class="app-content">
    <div class="bg-primary padding-x padding-bottom">
        <h3 class="title-page text-center text-white">{{ config('app.name', 'STCM') }}</h3>
    </div>
    <section class="padding-around">
        <div>
            <h1>Your Upcoming Schedule</h1>
        </div>
        <div>
            <x-alert />
            @foreach ($mySlots as $item)
            <table class="table border border-primary">
                <tr class="text-center">
                    <th>{{ $loop->iteration }}</th>
                    <th> </th>
                    <td>
                        <a href="" onclick="event.preventDefault();
                            if(confirm('Are you sure to delete?')){
                                document.getElementById('form-delete-{{ $item->id }}')
                                .submit()
                            }" class="text-danger border p-1"><i class="far fa-calendar-times"></i> Cancel Shift</a>
                            <form style="display: none;" id="form-delete-{{ $item->id }}" method="POST" action="{{ route('cancelSlot', $item->id) }}">
                                @csrf
                                @method('delete')
                            </form>
                    </td>
                </tr>
                <tr>
                    <th>Date</th>
                    <th>: </th>
                    <td>{{ $item->date }}</td>
                </tr>
                <tr>
                    <th>Shift</th>
                    <th>: </th>
                    <td>{{ $item->shift->name }}</td>
                </tr>
                <tr>
                    <th>Start</th>
                    <th>: </th>
                    <td>{{ date('g:i A', strtotime($item->start_time)) }}</td>
                </tr>
                <tr>
                    <th>End</th>
                    <th>: </th>
                    <td>{{ date('g:i A', strtotime($item->end_time)) }}</td>
                </tr>
                <tr>
                    <th>Traffic Point</th>
                    <th>: </th>
                    <td>{{ $item->trafficPoint->name.', '.$item->zone->name }}</td>
                </tr>
            </table>
            @endforeach
        </div>
    </section>
    </main>
    @include('mobile.component.nav-bottom')
    </div>
@endsection
