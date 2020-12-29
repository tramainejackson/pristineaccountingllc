<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Recommendation;
use Illuminate\Http\Request;
use App\ConsultRequest;
use App\Mail\NewContact;
use App\Mail\Update;

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

    /**
     * Show the testimonials web page.
     *
     * @return \Illuminate\Http\Response
     */
    public function testimonials() {
    	$recommendations = Recommendation::showTestimonials();

    	if($recommendations->count() >= 1) {
    		return view('testimonials', compact('recommendations'));
	    } else {
    		abort(404);
	    }
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
			\Mail::to($consult->email)->send(new Update($consult));
//			\Mail::to('lorenzodevonj@yahoo.com')->send(new NewContact($consult));

			return back()->with('status', 'Thank you for your request ' . $consult->first_name . '. We will contact you at ' . $consult->email . ' soon!');
		}
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function rate_request(Request $request) {
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
