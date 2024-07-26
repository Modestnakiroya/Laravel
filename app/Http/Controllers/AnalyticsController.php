<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        $schoolRankings = DB::table('attempts')
            ->join('schools', 'attempts.school_registration_number', '=', 'schools.school_registration_number')
            ->select('schools.name', DB::raw('count(*) as count'))
            ->where('attempts.score', '>=', 15)
            ->groupBy('schools.name')
            ->orderByDesc('count')
            ->get();

       $incompleteChallengePupils = DB::table('attempt_questions')
            ->select('username')
            ->where('questionsAttempted', '<', 10)
            ->groupBy('username')
            ->get();

        $bestPerformingSchools = DB::table('attempts')
            ->join('schools', 'attempts.school_registration_number', '=', 'schools.school_registration_number')
            ->select('schools.name', DB::raw('SUM(attempts.score) as total_score'))
            ->groupBy('schools.name')
            ->orderByDesc('total_score')
            ->limit(5)
            ->get();
        $worstPerformingSchools = DB::table('attempts')
            ->join('schools', 'attempts.school_registration_number', '=', 'schools.school_registration_number')
            ->select('schools.name', DB::raw('SUM(attempts.score) as total_score'))
            ->where('attempts.challengeNo', 'CH001')
            ->groupBy('schools.name')
            ->orderBy('total_score')
            ->limit(5)
            ->get(); 
        $schoolPerformanceOverYears = DB::table('attempts')
            ->join('schools', 'attempts.school_registration_number', '=', 'schools.school_registration_number')
            ->select(
                'schools.name as school_name',
                DB::raw('YEAR(DateAttempted) as year'),
                DB::raw('AVG(score) as average_score')
            )
            ->whereRaw('YEAR(DateAttempted) < 2024')
            ->groupBy('schools.name', 'year')
            ->orderBy('schools.name')
            ->orderBy('year')
            ->get()
            ->groupBy('school_name');

        $years = DB::table('attempts')
            ->selectRaw('DISTINCT YEAR(DateAttempted) as year')
            ->whereRaw('YEAR(DateAttempted) < 2024')
            ->orderBy('year')
            ->pluck('year');
         


        return view('analytics',compact('schoolRankings','worstPerformingSchools','incompleteChallengePupils','bestPerformingSchools','schoolPerformanceOverYears',
            'years'));
    }
    


}
