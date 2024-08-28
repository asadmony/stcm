<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('student.completeProfile');
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
        $data = $request->validate([
            'father_name' => ['required', 'string', 'max:255'],
            'mother_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'in:Female,Male'],
            'nid' => ['required', 'string', 'max:255'],
            'mobile_no' => ['required', 'string', 'max:20'],
            'address' => ['required', 'regex:/([- ,\/0-9a-zA-Z]+)/'],
            'education_institute' => ['required', 'string', 'max:255'],
            'education_level' => ['required', 'string', 'max:255'],
            'education_id' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
        ]);
        if (!auth()->user()->hasProfile()) {
            auth()->user()->profile()->create($data);
        } else {
            auth()->user()->profile()->update($data);
        }
        return redirect()->route('home')->with('success', 'Profile created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserProfile $userProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserProfile $userProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserProfile $userProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
