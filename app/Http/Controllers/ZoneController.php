<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Thana;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $districts = District::all();
        $zones = Zone::all();
        return view('admin.trafficZones.index', compact('districts', 'zones'));
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
    public function store(Request $request, Zone $zone)
    {
        // dd($request->all());
        $data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'thana_id' => ['required', 'integer', 'min:1', 'exists:App\Models\Thana,id'],
        ]);
        $zone->create($data);
        return redirect()->back()->with('success', 'Traffic Zone is created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Zone $zone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Zone $zone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Zone $zone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zone $zone)
    {
        //
    }
    public function getZonesByThana(Thana $thana) {
        $zones = Zone::where('thana_id', $thana->id)->get();
        return response()->json($zones);
    }
}
