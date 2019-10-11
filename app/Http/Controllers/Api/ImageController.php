<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
	public function upload($type)
	{
		request()->validate([
			'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		]);

		$image = request()->file('file')->store($type);

		return response(['image_url' => $image]);
	}
}
