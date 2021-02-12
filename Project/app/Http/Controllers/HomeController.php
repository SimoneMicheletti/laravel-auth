<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

	public function updateUserIcon(Request $request) {

		$request -> validate([
			'icon' => 'required|file'
		]);

		$this -> deleteUserIcon();

		$img = $request -> file('icon');

		$ext = $img -> getClientOriginalExtension();
		$name = rand(100000, 999999) . "_" . time();
		$destFile = $name . '-' . $ext;

		$file = $img -> storeAs('icon', $destFile, 'public');

		$user = Auth::user();
		$user -> icon = $destFile;
		$user -> save();

		return redirect() -> back();

	}

	public function clearUserIcon() {

		$this -> deleteUserIcon();

		$user = Auth::user();
		$user -> icon = NULL;
		$user -> save();

		return redirect() -> back();
	}

	public function deleteUserIcon() {

		$user = Auth::user();
		
		try {

			$fileName = $user -> icon;
	
			$file = storage_path('app/public/icon/' . $fileName);
			File::delete($file);

		} catch (\exception $e) {}
	}
}
