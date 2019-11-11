<?php

namespace App\Http\Controllers;

use App\Admin;
use App\ConsultRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ConsultRequestController extends Controller
{
	public function __construct() {
		$this->middleware(['auth']);
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
	    $admin = Auth::user();
	    $consults = ConsultRequest::all();
	    $open_consults = ConsultRequest::mostRecent();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
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
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
