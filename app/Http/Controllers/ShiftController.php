<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shifts = Shift::all();
        return view('admin.shifts.index', compact('shifts'));
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
    public function store(Request $request, Shift $shift)
    {
        $data = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'start' => ['required', 'before:end'],
            'end' => ['required', 'after:start'],
            'slots' => ['integer', 'min:1'],
        ]);
        $shift->create($data);
        return redirect()->back()->with('success', 'District created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shift $shift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shift $shift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shift $shift)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shift $shift)
    {
        //
    }
}
