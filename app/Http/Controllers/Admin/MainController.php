<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Links;

class MainController extends Controller
{
	
	public function index()
	{
		$finalized = Links::status('succeeded')->get();
	    return view('admin.main', compact('finalized'));
	}
}