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

class ShiftSlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $districts = District::all();
        return view('admin.shiftSlots.index', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ShiftSlot $shiftSlot, Request $request)
    {
        $data = $this->validate($request, [
            'district_id' => ['required', 'integer', 'min:1', 'exists:App\Models\District,id'],
            'thana_id' => ['required', 'integer', 'min:1', 'exists:App\Models\Thana,id'],
            'zone_id' => ['required', 'integer', 'min:1', 'exists:App\Models\Zone,id'],
            'traffic_point_id' => ['required', 'integer', 'min:1', 'exists:App\Models\TrafficPoint,id'],
        ]);

        $shiftSlotsCount = $shiftSlot->where('district_id', $data['district_id'])->where('thana_id', $data['thana_id'])->where('zone_id', $data['zone_id'])->where('traffic_point_id', $data['traffic_point_id'])->count();
        if ($shiftSlotsCount == 0) {
            $shifts = Shift::all();
            foreach ($shifts as $key => $value) {
                if(!$value->active) continue;
                $shiftSlot->create([
                    'district_id' => $data['district_id'],
                    'thana_id' => $data['thana_id'],
                    'zone_id' => $data['zone_id'],
                    'traffic_point_id' => $data['traffic_point_id'],
                    'shift_id' => $value->id,
                    'start_time' => $value->start,
                    'end_time' => $value->end,
                    'slots' => $value->slots,
                    'active' => true,
                ]);
            }
        }
        $selectedDistrict = District::where('id', $data['district_id'])->first();
        $selectedThana = Thana::where('id', $data['thana_id'])->first();
        $selectedZone = Zone::where('id', $data['zone_id'])->first();
        $selectedPoint = TrafficPoint::where('id', $data['traffic_point_id'])->first();
        $shiftSlots = $shiftSlot->where('district_id', $data['district_id'])->where('thana_id', $data['thana_id'])->where('zone_id', $data['zone_id'])->where('traffic_point_id', $data['traffic_point_id'])->get();
        $districts = District::all();
        return view('admin.shiftSlots.index', compact('shiftSlots', 'districts', 'selectedDistrict', 'selectedThana', 'selectedZone', 'selectedPoint'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShiftSlot $shiftSlot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShiftSlot $shiftSlot)
    {
        $data = $this->validate($request, [
            'slots' => ['integer', 'min:1'],
        ]);
        $shiftSlot->slots = $data['slots'];
        $shiftSlot->update();
        return;
    }

    public function updateStatus(Request $request, ShiftSlot $shiftSlot)
    {
        $shiftSlot->active = !$shiftSlot->active;
        $shiftSlot->update();
        return $shiftSlot->active;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShiftSlot $shiftSlot)
    {
        //
    }

    public function getPointsByZone(Zone $zone) {
        $trafficPoints = TrafficPoint::where('zone_id', $zone->id)->get();
        return response()->json($trafficPoints);
    }
}
