<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\TrafficPoint;
use App\Models\Zone;
use Illuminate\Http\Request;

class TrafficPointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $districts = District::all();
        $trafficPoints = TrafficPoint::all();
        return view('admin.trafficPoints.index', compact('districts', 'trafficPoints'));
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
    public function store(Request $request, TrafficPoint $trafficPoint)
    {
        // dd($request->all());
        $data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'zone_id' => ['required', 'integer', 'min:1', 'exists:App\Models\Zone,id'],
        ]);
        $trafficPoint->create($data);
        return redirect()->back()->with('success', 'Traffic Point is created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(TrafficPoint $trafficPoint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrafficPoint $trafficPoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TrafficPoint $trafficPoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrafficPoint $trafficPoint)
    {
        //
    }
}
