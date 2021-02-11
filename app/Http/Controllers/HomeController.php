<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('web');
    }

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('index');
	}

    /**
     * Show the about web page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about() {
	    return view('about');
    }

    /**
     * Show the pricing web page.
     *
     * @return \Illuminate\Http\Response
     */
    public function pricing() {
	    return view('pricing');
    }
}
