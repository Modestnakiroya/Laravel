<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;

class SchoolUploadController extends Controller
{
   
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'school_registration_number' => 'required|string|max:255|unique:schools',
        ]);

        // Create a new school instance and save it to the database
        $school = new School;
        $school->name = $request->name;
        $school->district = $request->district;
        $school->school_registration_number = $request->school_registration_number;
        $school->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'School uploaded successfully.');
    }









    





}
