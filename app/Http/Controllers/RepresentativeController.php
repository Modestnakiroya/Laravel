<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Representative;
use App\Models\School;
use Illuminate\Support\Facades\Hash;
class RepresentativeController extends Controller
{
    public function uploadRepresentative(Request $request)
    {
        
        $request->validate([
            'username' => 'required|string|max:255',
            'emailAddress' => 'required|email|max:255',
            'school_registration_number' => 'required|string|max:255|exists:schools,school_registration_number',
            'password' => 'required|string|min:8',
        ]);
        $schoolExists = School::where('school_registration_number', $request->school_registration_number)->exists();
        if (!$schoolExists) {
            return redirect()->back()->withErrors(['school_registration_number' => 'The specified school registration number does not exist.']);
        }

        Representative::create([
           'username' => $request->username,
            'emailAddress' => $request->emailAddress,
            'school_registration_number' => $request->school_registration_number,
            'password' => Hash::make($request->password),
         ]);

        
        return redirect()->back()->with('success', 'Representative uploaded successfully.');
    }
}