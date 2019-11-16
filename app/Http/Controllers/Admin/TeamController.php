<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Team;

class TeamController extends Controller
{
    public function index()
    {
    	$teams = Team::all();

      	return view('admin.team.index', ['teams' => $teams]);
    }
}
