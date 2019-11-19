<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ConsultRequest;

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
     * Show the home web page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about() {
	    return view('about');
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function consult_request(Request $request) {
//    	dd($request);

	    $this->validate($request, [
		    'email'      => 'required|email|max:50',
		    'first_name' => 'required|max:50',
		    'last_name'  => 'required|max:50',
		    'service'  => 'required',
		    'type'  => 'required',
	    ]);

		$consult = new ConsultRequest();
		$consult->email = $request->email;
		$consult->last_name = $request->last_name;
		$consult->first_name = $request->first_name;
		$consult->service = $request->service;
		$consult->type = $request->type;

		if($consult->save()) {
			return back()->with('status', 'Thank you for your request ' . $consult->first_name . '. We will contact you at ' . $consult->email . ' soon!');
		}
    }
}
