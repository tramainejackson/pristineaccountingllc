<?php

namespace App\Mail;

use App\ConsultRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewContact extends Mailable
{
	use Queueable, SerializesModels;

	/**
	 * The Consult Request instance
	 *
	 * @var consult_request
	 */
	public $consult_request;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct(ConsultRequest $consult_request)
	{
		$this->consult_request = $consult_request;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->subject('New Contact Added')->view('emails.new_contact', compact('consult_request'));
	}
}
