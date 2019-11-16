<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;

class TeamController extends Controller
{
    public function index()
    {
    	$teams = Team::where('is_shown', true)->with('recruits')->get();

      	return view('team.index', ['teams' => $teams]);
    }

    public function show($id)
    {
    	$team = Team::findOrFail($id);

      	return view('team.create', ['team' => $team]);
    }

    public function userTeams()
    {
        $teams = auth()->user()->teams()->get();

        return view('team.my-teams', ['teams' => $teams]);
    }

    
    public function showSingle($title)
    {
        $team = Team::where(['title' => $title])->with('recruits', 'users')->first();

        return view('team.show', ['team' => $team]);
    }
}
