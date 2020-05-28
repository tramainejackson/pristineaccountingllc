<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Recommendation;
use App\ConsultRequest;
use App\ConsultContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;

class AdminController extends Controller
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
	    $open_consults = ConsultRequest::leastRecent();
	    $testimonials = Recommendation::all();
	    $today = Carbon::now();
	    $consult_created = null;
	    $testimonial_created = null;
	    $open_consults->isNotEmpty() ? $open_consults = $open_consults->count() : $open_consults = 0;
	    $testimonials->isNotEmpty() ? $testimonials = $testimonials->count() : $testimonials = 0;

	    // Create Carbon Date if there is an open consult
	    $open_consults !== 0 ? $consult_created = new Carbon(ConsultRequest::leastRecent()->first()->created_at) : null;

	    // Create Carbon Date if there is testimonials availble
	    $testimonials !== 0 ? $testimonial_created = new Carbon(Recommendation::all()->first()->created_at) : null;

        return view('admin.index', compact('admin', 'consults', 'open_consults', 'consult_created', 'today', 'testimonials', 'testimonial_created'));
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
    public function update(Request $request)
    {
        $admin = Admin::first();
        $admin->accounting_rate = $request->accounting_rate;
        $admin->tax_prep_rate = $request->tax_prep_rate;
        $admin->budgeting_rate = $request->budgeting_rate;

        if($admin->save()) {
	        return redirect()->back()->with('status', 'Pricing Updated!');
        } else {
	        return redirect()->back()->with('status', 'Pricing Not Updated, Please Try Again.');
        }

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
