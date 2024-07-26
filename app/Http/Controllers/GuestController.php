<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        $topStudentsAddition = DB::table('attempts')
        ->select('username', 'score')
        ->where('challengeNo', 'CH001')
        ->orderByDesc('score')
        ->limit(3)
        ->get();

        $topStudentsSubtraction = DB::table('attempts')
        ->select('username', 'score')
        ->where('challengeNo', 'CH002')
        ->orderByDesc('score')
        ->limit(3)
        ->get();

        $schoolRankings = DB::table('attempts')
        ->join('schools', 'attempts.school_registration_number', '=', 'schools.school_registration_number')
        ->select('schools.name', DB::raw('count(*) as count'))
        ->where('attempts.score', '>=', 15)
        ->groupBy('schools.name')
        ->orderByDesc('count')
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
         
        return view('guest',compact('schoolRankings','schoolPerformanceOverYears','years','topStudentsAddition','topStudentsSubtraction'));   
    }
}
