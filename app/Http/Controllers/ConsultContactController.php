<?php

namespace App\Http\Controllers;

use App\Admin;
use App\ConsultRequest;
use App\ConsultContact;
use App\ConsultResponse;
use App\Invoice;
use App\Recommendation;
use Illuminate\Validation\Rule;
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
    public function store(Request $request) {
	    $this->validate($request, [
		    'email'      => 'required|email|max:100|unique:consult_contacts,email',
		    'first_name' => 'required|max:50',
		    'last_name'  => 'required|max:50',
		    'phone'      => 'nullable',
	    ]);

	    $contact = new ConsultContact();
	    $contact->email      = $request->email;
	    $contact->last_name  = $request->last_name;
	    $contact->first_name = $request->first_name;
	    $contact->phone      = $request->phone;

	    if($contact->save()) {
		    return back()->with('status', 'Thank you for your request ' . $contact->first_name . '. We will contact you at ' . $contact->email . ' soon!');
	    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(ConsultContact $consult_contact) {
    	$invoices = $consult_contact->invoices;
    	$recommendations = $consult_contact->recommendation;
    	$requests = $consult_contact->consultRequest;

	    return view('admin.contacts.edit', compact('consult_contact', 'invoices', 'recommendations', 'requests'));
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
		    'email'      => [
                    'required',
                    'email',
                    'max:100',
                    Rule::unique('consult_contacts')->ignore($consult_contact->id),
                ],
		    'first_name' => 'required|max:50',
		    'last_name'  => 'required|max:50',
		    'phone'      => 'nullable|numeric|integer',
		    'avatar'     => 'nullable|image',
	    ]);

	    $consult_contact->email         = $request->email;
	    $consult_contact->last_name     = $request->last_name;
	    $consult_contact->first_name    = $request->first_name;
	    $consult_contact->phone         = $request->phone;

	    if($request->hasFile('avatar')) {
		    $avatar = $consult_contact->create_avatar($request->file('avatar'), strtolower(str_ireplace(' ', '_', $consult_contact->full_name())));

		    if($avatar[0] == 'success') {
			    $consult_contact->avatar = $avatar[1];
		    } else {

		    }
	    }

	    if($consult_contact->save()) {
		    return back()->with('status', 'Contact Updated Successfully');
	    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsultContact $consult_contact) {
        if($consult_contact) {

        	$consult_recommendations = $consult_contact->recommendation;
        	$consult_request = $consult_contact->consultRequest;

        	//Remove contact
        	if($consult_contact->delete()) {
				//Remove any recommendations if any exist
		        if($consult_recommendations->isNotEmpty()) {
			        foreach ($consult_recommendations as $recommendation) {
				        if($recommendation->delete()){}
			        }
		        }

				//Remove any consults if any exist
		        if($consult_request->isNotEmpty()) {
			        foreach ($consult_request as $request) {
				        //Remove request response if one available
				        if($request->consultResponse != null) {
					        if($request->consultResponse->delete()) {}
				        }

				        if($request->delete()) {}
			        }
		        }

		        return redirect()->action('ConsultContactController@index')->with('status', 'Contact Removed Successfully');
	        }
        }
    }
}
