<?php

namespace App\Http\Controllers;

use App\ConsultContact;
use App\Recommendation;
use App\Admin;
use App\ConsultRequest;
use App\ConsultResponse;
use App\Mail\NewConsultContact;
use App\Mail\NewContactSurvey;
use App\Mail\AdminContactSurvey;
use App\Mail\NewCompletedSurvey;
use App\Mail\AdminCompletedSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RecommendationController extends Controller
{
	public function __construct() {
		$this->middleware(['auth'])->except(['index', 'store', 'survey']);
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
    	$recommendations = Recommendation::all();
	    $get_show_recommendations = Recommendation::showTestimonials();

        return view('admin.recommendations.index', compact('recommendations', 'get_show_recommendations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
	    return view('admin.recommendations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
    	if($request->survey_id == null) {
		    $this->validate($request, [
			    'first_name'    => 'required|max:50',
			    'last_name'     => 'required|max:50',
			    'email'         => 'required|email|max:100',
			    'meet_needs'    => 'required|integer',
			    'recommend'     => 'required|integer',
			    'rating'        => 'required|numeric',
			    'suggestions'   => 'nullable',
			    'tell_someone'  => 'nullable',
		    ]);

		    $recommendation                 = new Recommendation();
		    $recommendation->meet_needs     = $request->meet_needs;
		    $recommendation->recommend      = $request->recommend;
		    $recommendation->rating         = $request->rating;
		    $recommendation->suggestions    = $request->suggestions;
		    $recommendation->tell_someone   = $request->tell_someone;

		    // Get contact by the email address
		    $survey_contact = ConsultContact::emailId($request->email);
	    } else {
		    $this->validate($request, [
			    'meet_needs'    => 'required|integer',
			    'recommend'     => 'required|integer',
			    'rating'        => 'required|numeric',
			    'suggestions'   => 'nullable',
			    'tell_someone'  => 'nullable',
		    ]);

		    $recommendation                 = new Recommendation();
		    $recommendation->meet_needs     = $request->meet_needs;
		    $recommendation->recommend      = $request->recommend;
		    $recommendation->rating         = $request->rating;
		    $recommendation->suggestions    = $request->suggestions;
		    $recommendation->tell_someone   = $request->tell_someone;

		    // Get contact by the survey ID
		    $survey_contact = ConsultContact::surveyId($request->survey_id);
	    }

		if($survey_contact->isNotEmpty()) {
			$recommendation->consult_contact_id = $survey_contact->first()->id;

		    if($recommendation->save()) {
			    \Mail::to($survey_contact->first()->email)->send(new NewCompletedSurvey($survey_contact->first()));
			    \Mail::to('pristineaccting@gmail.com')->send(new AdminCompletedSurvey($survey_contact->first()));

		        return redirect()->action('HomeController@index')->with('status', 'Thanks for taking our quick survey. As a small start up company, your feedback is a tremendous asset!');
		    } else {
			    return redirect()->action('HomeController@index')->with('bad_status', 'Unable to process the survey. Please try taking the survey again!');
		    }
        } else {

			$contact = new ConsultContact();
			$contact->email         = $request->email;
			$contact->last_name     = $request->last_name;
			$contact->first_name    = $request->first_name;

			if($contact->save()) {
				$recommendation->consult_contact_id = $contact->id;

				if($recommendation->save()) {
					\Mail::to($contact->email)->send(new NewCompletedSurvey($contact));
					\Mail::to('pristineaccting@gmail.com')->send(new AdminCompletedSurvey($contact));

					return redirect()->action('HomeController@index')->with('status', 'Thanks for taking our quick survey. As a small start up company, your feedback is a tremendous asset!');
				} else {
					return redirect()->action('HomeController@index')->with('bad_status', 'Unable to process the survey. Please try taking the survey again!');
				}
			} else {
				return redirect()->action('HomeController@index')->with('bad_status', 'Unable to process the survey. Please try taking the survey again!');
			}
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function show(Recommendation $recommendation) {
	    //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function edit(Recommendation $recommendation) {
    	$contact = $recommendation->consultContact;

	    return view('admin.recommendations.edit', compact('recommendation', 'contact'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recommendation $recommendation) {
	    $this->validate($request, [
		    'meet_needs'    => 'required|integer',
		    'recommend'     => 'required|integer',
		    'rating'        => 'required|numeric',
		    'suggestions'   => 'nullable',
		    'tell_someone'  => 'nullable',
	    ]);

	    $recommendation->meet_needs         = $request->meet_needs;
	    $recommendation->recommend          = $request->recommend;
	    $recommendation->rating             = $request->rating;
	    $recommendation->suggestions        = $request->suggestions;
	    $recommendation->tell_someone       = $request->tell_someone;
	    $recommendation->show_testimonial   = $request->show_testimonial;

	    if($recommendation->save()) {
	    	return back()->with('status', 'Testimonial saved successfully!');
	    } else {
		    return back()->with('bad_status', 'Testimonial not saved. Please try again.');
	    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recommendation $recommendation) {
        if($recommendation->delete()) {
	        return redirect()->action('RecommendationController@index')->with('status', 'Review removed successfully!');
        }
    }

    /**
     * Survey the specified resource from storage.
     *
     * @param  \App\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function survey($survey_id) {
    	$survey_contact = ConsultContact::surveyId($survey_id);

    	if($survey_contact->count() > 0) {
		    return view('admin.recommendations.create', compact('survey_id'));
	    } else {
    		abort(404);
	    }
    }

    /**
     * Survey the specified resource from storage.
     *
     * @param  \App\Recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function send_survey(ConsultContact $consult_contact) {
    	// Send an email if the consult contact exist
    	if($consult_contact) {
    		// Create/Replace survery id and save to the contact
		    $consult_contact->survey_id = str_ireplace('/', 'z',bcrypt(str_ireplace(' ', '_', $consult_contact->full_name() . $consult_contact->id)));

		    if($consult_contact->save()) {
			    // Send survey in an email
			    \Mail::to($consult_contact->email)->send(new NewContactSurvey($consult_contact));
			    \Mail::to('pristineaccting@gmail.com')->send(new AdminContactSurvey($consult_contact));
			    return back()->with('status', 'Email Sent Successfully To Contact');
		    } else {
			    return back()->with('status', 'Survey ID unable to be saved to contact. Please try again');
		    }

	    } else {
		    return back()->with('bad_status', 'Email Not Sent, Please Try Sending Again');
	    }
    }
}
