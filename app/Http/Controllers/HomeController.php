<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\ShiftSlot;
use App\Models\SlotBooking;
use App\Models\Thana;
use App\Models\TrafficPoint;
use App\Models\Zone;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    public function __construct(Agent $agent)
    {
        $this->middleware('auth');
        if($agent->isDesktop())
        {
          //$this->device = 'theme.'.config('app.theme').'.';
        }
        else
        {
          $this->device = 'mobile.'; //mobile and tab will use
        }
    }

    protected $device;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view($this->device.'home');
    }
    public function bookShift() {
        $districts = District::all();
        return view($this->device.'student.bookShift', compact('districts'));
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
        return view($this->device.'student.bookShift', compact('shiftSlots', 'districts', 'selectedDistrict', 'selectedThana', 'selectedZone', 'selectedPoint'));
    }

    public function store(ShiftSlot $shiftSlot, Request $request, SlotBooking $slotBooking){
        $data = $this->validate($request, [
            'date' => ['required', 'date', 'after_or_equal:today'],
            'slots' => ['required', 'exists:App\Models\ShiftSlot,id'],
        ]);
        foreach ($request->slots as $key => $value) {
            $shiftslot = $shiftSlot->where('id', $value)->first();
            $bookingCount = $shiftslot->slotBookings()->where('date', $data['date'])->count();
            if ($bookingCount < $shiftslot->slots) {
                $shiftslot->slotBookings()->create([
                    'date' => $data['date'],
                    'user_id' => auth()->user()->id,
                    'district_id' => $shiftslot->district_id,
                    'thana_id' => $shiftslot->thana_id,
                    'zone_id' => $shiftslot->zone_id,
                    'traffic_point_id' => $shiftslot->traffic_point_id,
                    'start_time' => $shiftslot->start,
                    'end_time' => $shiftslot->end,
                ]);
            }
            else{
                $slotError[] = $shiftslot->id;
            }
        }

    }

}
