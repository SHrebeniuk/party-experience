<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;

class TeamController extends Controller
{
    public function index()
    {
    		$teams = auth()->user()->teams()->get();

      	return view('admin.team.index', ['teams' => $teams]);
    }

    public function show($id)
    {
    		$team = Team::findOrFail($id);

      	return view('admin.team.create', ['team' => $team]);
    }

    
}
