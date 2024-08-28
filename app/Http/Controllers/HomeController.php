<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Shift;
use App\Models\ShiftSlot;
use App\Models\Thana;
use App\Models\TrafficPoint;
use App\Models\Zone;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function bookShift() {
        $districts = District::all();
        return view('student.bookShift', compact('districts'));
    }
    public function getThanasByDistrict(District $district)
    {
        $thanas = Thana::where('district_id', $district->id)->get();
        return response()->json($thanas);
    }
    public function getZonesByThana(Thana $thana) {
        $zones = Zone::where('thana_id', $thana->id)->get();
        return response()->json($zones);
    }
    public function getPointsByZone(Zone $zone) {
        $trafficPoints = TrafficPoint::where('zone_id', $zone->id)->get();
        return response()->json($trafficPoints);
    }

    public function showShifts(ShiftSlot $shiftSlot, Request $request)
    {
        $data = $this->validate($request, [
            'district_id' => ['required', 'exists:App\Models\District,id'],
            'thana_id' => ['required', 'exists:App\Models\Thana,id'],
            'zone_id' => ['required', 'exists:App\Models\Zone,id'],
            'traffic_point_id' => ['required', 'exists:App\Models\TrafficPoint,id'],
        ]);
        $selectedDistrict = District::where('id', $data['district_id'])->first();
        $selectedThana = Thana::where('id', $data['thana_id'])->first();
        $selectedZone = Zone::where('id', $data['zone_id'])->first();
        $selectedPoint = TrafficPoint::where('id', $data['traffic_point_id'])->first();
        $shiftSlots = $shiftSlot->where('district_id', $data['district_id'])->where('thana_id', $data['thana_id'])->where('zone_id', $data['zone_id'])->where('traffic_point_id', $data['traffic_point_id'])->get();
        $districts = District::all();
        return view('student.bookShift', compact('shiftSlots', 'districts', 'selectedDistrict', 'selectedThana', 'selectedZone', 'selectedPoint'));
    }
}
