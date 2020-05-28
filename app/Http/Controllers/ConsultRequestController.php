<?php

namespace App\Http\Controllers;

use App\Admin;
use App\ConsultRequest;
use App\ConsultContact;
use App\ConsultResponse;
use App\Mail\NewConsultContact;
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

	    return view('admin.consult_request.create', compact('admin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
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
    public function edit(ConsultRequest $consult) {
	    return view('admin.consult_request.edit', compact('consult'));
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

	/**
	 * Create an invoice.
	 *
	 * @param  \App\Admin  $admin
	 * @return \Illuminate\Http\Response
	 */
	public function create_invoice(Request $request, ConsultRequest $consult) {
//		dd($request);
		$template = Storage::disk('public')->exists('documents/Invoice_Template.docx');

		if($template) {
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

			$templateProcessor->saveAs('/Applications/XAMPP/xamppfiles/htdocs/pristineaccountingllc/public/storage/documents/TestTemplate.docx');

			if($template = Storage::disk('public')->exists('documents/TestTemplate.docx')) {
				return back()->with('status', 'Invoice Created Successfully');
			} else {

			}
		} else {
			dd('Template Not Found');
		}
	}
}
