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
	    $this->validate($request, [
		    'email'      => 'required|email|max:50',
		    'first_name' => 'required|max:50',
		    'last_name'  => 'required|max:50',
	    ]);

		$consult = new ConsultRequest();
		$consult->email = $request->email;
		$consult->last_name = $request->last_name;
		$consult->first_name = $request->first_name;

		if($consult->save()) {
			return back()->with('status', 'Thank you for your request ' . $consult->first_name . '. We will contact you at ' . $consult->email . ' soon!');
		}
    }
}
