<?php

namespace App\Http\Controllers;

use App\Admin;
use App\ConsultRequest;
use App\ConsultResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ConsultResponseController extends Controller
{
	public function __construct() {
		$this->middleware(['auth'])->except('store');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
	    $admin = Auth::user();
	    $consults = ConsultRequest::all();
	    $open_consults = ConsultRequest::leastRecent();
	    $today = Carbon::now();
	    $consult_created = null;

	    $open_consults->isNotEmpty() ? $open_consults->count() : 0;

	    // Create Carbon Date if there is an open consult
	    $open_consults !== 0 ? $consult_created = new Carbon($open_consults->first()->created_at) : null;

        return view('admin.consult_request.index', compact('admin', 'consults', 'open_consults', 'consult_created', 'today'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consult_request = ConsultRequest::find($request->consult_request);
        $consult_request->responded = 'Y';

        if($consult_request->save()) {
	        $consult_response = $consult_request->consultResponse()->create([
		        'response' => 'This is working'
	        ]);

	        return back()->with('status', 'Request Moved To Completed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ConsultResponse  $consult_response
     * @return \Illuminate\Http\Response
     */
    public function show(ConsultResponse $consult_response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ConsultResponse  $consult_response
     * @return \Illuminate\Http\Response
     */
    public function edit(ConsultResponse $consult_response)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConsultResponse $consult_response)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsultResponse $consult_response) {
    	if($consult_response->consultRequest !== null) {
    	    if($consult_response->consultRequest->delete()) {
		        // Removed Consult Response
		        if ($consult_response->delete()) {
			        return back()->with('status', 'Consult Response Removed and Archived Successfully');
		        } else {
			        return back()->with('bad_status', 'Unable To Remove Consult Response, Please Try Again');
		        }
	        }
	    } else {
		    // Removed Consult Response
		    if ($consult_response->delete()) {
			    return back()->with('status', 'Consult Response Removed and Archived Successfully');
		    } else {
			    return back()->with('bad_status', 'Unable To Remove Consult Response, Please Try Again');
		    }
	    }
    }
}
