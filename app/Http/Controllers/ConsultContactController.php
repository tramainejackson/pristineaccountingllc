<?php

namespace App\Http\Controllers;

use App\Admin;
use App\ConsultRequest;
use App\ConsultContact;
use App\ConsultResponse;
use App\Mail\NewConsultContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ConsultContactController extends Controller
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
	    $contacts = ConsultContact::all();

	    return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
	    $admin = Auth::user();

	    return view('admin.contacts.create', compact('admin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    //	    dd($request);

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
		    $contact = new ConsultContact();
		    $contact->consult_request_id = $consult->id;
		    $contact->email = $consult->email;
		    $contact->last_name = $consult->last_name;
		    $contact->first_name = $consult->first_name;

		    if($contact->save()) {}

//		    \Mail::to($consult->email)->send(new Update($consult));
		    \Mail::to($consult->email)->send(new NewConsultContact($contact));

		    return back()->with('status', 'Thank you for your request ' . $consult->first_name . '. We will contact you at ' . $consult->email . ' soon!');
	    }
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
    public function edit(ConsultContact $consult_contact) {
	    return view('admin.contacts.edit', compact('consult_contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConsultContact $consult_contact) {

	    $this->validate($request, [
		    'email'      => 'required|email|max:50',
		    'first_name' => 'required|max:50',
		    'last_name'  => 'required|max:50',
		    'phone'      => 'numeric|integer',
	    ]);

	    $consult_contact->email = $request->email;
	    $consult_contact->last_name = $request->last_name;
	    $consult_contact->first_name = $request->first_name;
	    $consult_contact->phone = $request->phone;

	    if($consult_contact->save()) {

	    }

	    return back()->with('status', 'Contact Updated');
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
