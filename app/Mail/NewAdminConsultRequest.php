<?php

namespace App\Mail;

use App\ConsultRequest;
use App\ConsultContact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewAdminConsultRequest extends Mailable
{
	use Queueable, SerializesModels;

	/**
	 * The Consult Request instance
	 *
	 * @var consult_contact
	 * @var consult_request
	 */
	public $consult_contact;
	public $consult_request;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct(ConsultContact $consult_contact, ConsultRequest $consult_request) {
		$this->consult_contact = $consult_contact;
		$this->consult_request = $consult_request;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		return $this->subject('New Consult Requested')->view('emails.admin_new_consult', compact('consult_contact', 'consult_request'));
	}
}
