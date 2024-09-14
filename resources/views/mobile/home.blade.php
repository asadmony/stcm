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
    </section>
    </main>
    @include('mobile.component.nav-bottom')
    </div>
@endsection
