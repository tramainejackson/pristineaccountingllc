<?php

namespace App\Http\Controllers;

use App\Admin;
use App\ConsultRequest;
use App\ConsultContact;
use App\ConsultResponse;
use App\Invoice;
use App\Mail\NewAdminConsultRequest;
use App\Mail\NewConsultRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;

class ConsultRequestController extends Controller
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
	    $consults_responses = ConsultResponse::all();
	    $open_consults = ConsultRequest::leastRecent();
	    $today = Carbon::now();
	    $consult_created = null;

	    $open_consults->isNotEmpty() ? $open_consults = $open_consults->count() : $open_consults = 0;

	    // Create Carbon Date if there is an open consult
	    $open_consults !== 0 ? $consult_created = new Carbon(ConsultRequest::leastRecent()->first()->created_at) : null;

        return view('admin.consult_request.index', compact('admin', 'consults', 'open_consults', 'consult_created', 'today', 'consults_responses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
	    $admin = Auth::user();
	    $contacts = ConsultContact::all();

	    return view('admin.consult_request.create', compact('admin', 'contacts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
    	if(Auth::check()) {
			$this->validate($request, [
			    'service'    => 'required',
			    'type'       => 'required',
			    'message'    => 'required',
			    'contact_id' => 'required|integer',
		    ]);
	    } else {
			$this->validate($request, [
			    'email'      => 'required|email|max:100',
			    'first_name' => 'required|max:50',
			    'last_name'  => 'required|max:50',
			    'service'    => 'required',
			    'type'       => 'required',
			    'message'    => 'required',
		    ]);
	    }

		// Get contact by the email address
	    $contact_check = isset($request->contact_id) ? ConsultContact::find($request->contact_id) : ConsultContact::emailId($request->email);

	    // Create a new consultation request
	    $consult = new ConsultRequest();
	    $consult->service            = $request->service;
	    $consult->type               = $request->type;
	    $consult->message            = $request->message;
	    $consult->consult_contact_id = isset($request->contact_id) ? $contact_check->id : null;

	    if(isset($request->email)) {
	    	if($contact_check->isEmpty()) {
			    // Create a new contact
			    $contact = new ConsultContact();
			    $contact->email = $request->email;
			    $contact->last_name = $request->last_name;
			    $contact->first_name = $request->first_name;
		    } else {
	    		$contact = $contact_check->first();
		    }

		    // Save contact
		    if($contact->save()) {

			    // Add contact id to the consultation request
			    $consult->consult_contact_id = $contact->id;

			    // Save consultation
			    if($consult->save()) {

				    \Mail::to($consult->email)->send(new NewConsultRequest($consult));

				    return redirect()->action('HomeController@index')->with('status', 'Thank you for your request ' . $contact->first_name . '. We will contact you at ' . $contact->email . ' soon!');
			    } else {}
		    }
	    } else {
		    // Save consultation
		    if($consult->save()) {

			    \Mail::to($consult->email)->send(new NewAdminConsultRequest($consult));

			    return redirect()->action('ConsultRequestController@index')->with('status', 'You have added a new consult request for ' . $consult->consultContact->first_name . '.');
		    } else {}
	    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ConsultRequest $consult
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ConsultRequest $consult
     * @return \Illuminate\Http\Response
     */
    public function edit(ConsultRequest $consult) {
//    	dd($consult->invoice);

    	$invoice_number = $consult->invoice != null ? $consult->invoice->NewInvoiceNumber($consult->invoice->invoice_number) : '';

	    return view('admin.consult_request.edit', compact('consult', 'invoice_number'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ConsultRequest $consult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConsultRequest $consult) {
    	$consult->responded = 'Y';

	    if($consult->save()) {
	    	$consult_response = new ConsultResponse();
		    $consult_response->consult_request_id = $consult->id;
		    $consult_response->response = $request->addt_info == null ? 'No additional information added.' : $request->addt_info;

		    if($consult_response->save()) {
		    	return back()->with('status', 'Consult Request Completed Successfully and Response Created');
		    } else {
		    	return back()->with('status', 'Consult Request Saved Successfully but no Response Created');
		    }
	    } else {
		    return back()->with('bad_status', 'Unable To Remove Consult Request, Please Try Again');
	    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ConsultRequest $consult
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsultRequest $consult) {
    	// Removed Consult Request
        if($consult->delete()) {
	        return back()->with('status', 'Consult Request Removed Successfully');
        } else {
	        return back()->with('bad_status', 'Unable To Remove Consult Request, Please Try Again');
        }
    }

	/**
	 * Create an invoice.
	 *
	 * @param  \App\Request $request
	 * @param  \App\ConsultRequest $consult
	 * @return \Illuminate\Http\Response
	 */
	public function create_invoice(Request $request, ConsultRequest $consult) {
		$this->validate($request, [
			'company_name'              => 'required',
			'owner_name'                => 'required',
			'company_address'           => 'required',
			'payee'                     => 'required',
			'payee_address'             => 'required',
			'payee_payment_method'      => 'required',
			'payee_contact_name'        => 'required',
			'payee_contact_phone'       => 'required',
			'payee_contact_email'       => 'required|email',
			'invoice_date'              => 'required',
			'invoice_reason'            => 'required',
			'invoice_number'            => 'required',
			'invoice_terms'             => 'required',
			'invoice_due_date'          => 'required',
			'invoice_amount'            => 'required',
			'project_period'            => 'required',
			'project_name'              => 'required',
			'description_of_services'   => 'required',
		]);

		// Verify template exist in documents
		$template = Storage::disk('public')->exists('documents/Invoice_Template.docx');

		if($template) {
//			$template = '/var/www/pristineaccountingllc.com/public/storage/documents/Invoice_Template.docx';
			$template = '/Applications/XAMPP/xamppfiles/htdocs/pristineaccountingllc/public/storage/documents/Invoice_Template.docx';
			$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template);

			$values = [
				$request->company_name,
				$request->owner_name,
				$request->company_address,
				$request->payee,
				$request->payee_address,
				$request->payee_payment_method,
				$request->payee_contact_name,
				$request->payee_contact_phone,
				$request->payee_contact_email,
				$request->invoice_date,
				$request->invoice_reason,
				$request->invoice_number,
				$request->invoice_terms,
				$request->invoice_due_date,
				$request->invoice_amount,
				$request->project_period,
				$request->project_name,
				$request->description_of_services,
			];
			$placeholders = [
				'company_name',
				'owner_name',
				'company_address',
				'payee',
				'payee_address',
				'payee_payment_method',
				'payee_contact_name',
				'payee_contact_phone',
				'payee_contact_email',
				'invoice_date',
				'invoice_reason',
				'invoice_number',
				'invoice_terms',
				'invoice_due_date',
				'invoice_amount',
				'project_period',
				'project_name',
				'description_of_services',
			];

			$templateProcessor->setValue($placeholders, $values);

//			$templateProcessor->saveAs('/var/www/pristineaccountingllc.com/public/storage/documents/'. strtolower($consult->first_name . '_' . $consult->last_name) . '_' .$request->invoice_number . '.docx');
			$templateProcessor->saveAs('/Applications/XAMPP/xamppfiles/htdocs/pristineaccountingllc/public/storage/documents/'. strtolower($consult->first_name . '_' . $consult->last_name) . '_' .$request->invoice_number . '.docx');

			if($template = Storage::disk('public')->exists('documents/'. strtolower($consult->first_name . '_' . $consult->last_name) . '_' .$request->invoice_number . '.docx')) {
				$invoice = new Invoice();
				$invoice->consult_request_id = $consult->id;
				$invoice->consult_contact_id = $consult->consult_contact_id;
				$invoice->invoice_number     = $request->invoice_number;
				$invoice->file_name          = strtolower($consult->first_name . '_' . $consult->last_name) . '_' . $request->invoice_number;

				if($invoice->save()) {
					return redirect()->action('ConsultContactController@edit', $consult->id)->with('status', 'Invoice Created Successfully');
				} else {
					return back()->with('bad_status', 'Invoice documents created but unable to save invoice to database. Please try again.');
				}
			} else {
				return back()->with('status', 'Unable to create invoice. Please try again.');
			}
		} else {
			dd('Template Not Found');
		}
	}
}
