<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\User;

class UserController extends Controller
{
	public function edit()
	{   
		$user = Auth::user();

		return view('admin.user.profile', compact('user'));
	}

	public function update()
	{ 
		request()->validate([
			'name' => 'required',
			'email' => 'required|email',
			'description' => 'required',
		]);

		$user = auth()->user();

		$user->fill([
			'name' => request('name'),
			'email' => request('email'),
			'description' => request('description'),
			'photo' => request('photo')
		]);

		$user->save();

		return back();
	}

	public function updatePhoto($type = 'photo'){
        request()->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = request()->file('photo')->store('users');

        $user = auth()->user();
        $user->photo = $image;
        $user->save();

        return back()
            ->with('success','You have successfully upload image.');

    }
}