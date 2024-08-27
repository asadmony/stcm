<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Thana;
use Illuminate\Http\Request;

class ThanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(District $district, Thana $thana)
    {
        $districts = $district->all();
        $thanas = $thana->all();
        return view('admin.thanas.index', compact('districts', 'thanas'));
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
    public function store(Request $request, Thana $thana)
    {
        $data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'district_id' => ['required', 'integer', 'min:1', 'exists:App\Models\District,id'],
        ]);
        $thana->create($data);
        return redirect()->back()->with('success', 'Thana created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Thana $thana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Thana $thana)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Thana $thana)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thana $thana)
    {
        //
    }

    public function getThanasByDistrict(District $district)
    {
        $thanas = Thana::where('district_id', $district->id)->get();
        return response()->json($thanas);
    }
}
