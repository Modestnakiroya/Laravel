<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;
use App\Imports\QuestionImport;
use Maatwebsite\Excel\Facades\Excel;

class FileUploadController extends Controller
{
    public function uploadFiles(Request $request)
    {
        $request->validate([
            'challengeNo' => 'required|string',
            'openingDate' => 'required|date',
            'closingDate' => 'required|date',
            'duration' => 'required|integer',
            'file1' => 'required|file|mimes:xlsx,xls|max:2048', // Adjust as needed
            'file2' => 'required|file|mimes:xlsx,xls|max:2048',
        ]);

        $challenge = new Challenge;
        $challenge->challengeNo = $request->challengeNo;
        $challenge->openingDate = $request->openingDate;
        $challenge->closingDate = $request->closingDate;
        $challenge->duration = $request->duration;
        $challenge->save();

        $questionsFilePath = $request->file('file1')->store('uploads');
        $answersFilePath = $request->file('file2')->store('uploads');

        $challenge_id = $challenge->challengeNo;

        new QuestionImport($questionsFilePath, $answersFilePath, $challenge_id);

        // Handle success response or redirect
        return back()->with('success', 'Files uploaded successfully');
    }
}
