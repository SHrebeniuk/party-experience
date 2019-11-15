<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Team;
use App\User;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();

        return response()->json($teams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'image_url' => 'required',
        ]);

        $team = Team::create([
            'title' => request('title'),
            'subdescription' => request('subdescription'),
            'description' => request('description'),
            'image_url' => request('image_url')
        ]);

        $team->owner_id = request('owner_id');
        // $team->users()->attach(request('owner_id'));
        $team->save();

        $user = auth()->user();
        $user->team_id = $team->id;
        $user->save();

        return response()->json($team);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);

        $team->fill([
            'title' => request('title'),
            'subdescription' => request('subdescription'),
            'description' => request('description'),
            'image_url' => request('image_url')
        ]);

        $team->save();

        return response()->json($team);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function join($id, $type)
    {
        $team = Team::findOrFail($id);

        $type == 'detach' ? $team->recruits()->detach(auth()->user()->id)
                          : $team->recruits()->attach(auth()->user()->id);

        $teams = Team::where('is_shown', true)->with('recruits')->get();

        return response()->json($teams);
    }

    public function updateMember($id, $member_id, $type)
    {
        $team = Team::findOrFail($id);

        $user = User::findOrFail($member_id);

        if($type == 'accept') {
            $user->team_id = $id;
            $user->save();
        }

        $team->recruits()->detach($member_id);

        $team = Team::where('id', $id)->with('recruits', 'users')->first();

        return response()->json($team);
    }
}
