<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	/**
	 * Get the consult contact record associated with the invoices.
	 */
	public function consultContact()	{
		return $this->belongsTo('App\ConsultContact');
	}

	/**
	 * Get the consult request record associated with the invoices.
	 */
	public function consultRequest()	{
		return $this->belongsTo('App\ConsultRequest');
	}

	/**
	 * Get the contacts phone number.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function NewInvoiceNumber($value) {
		if($value == null) {
			return '001';
		} else {
			if(strlen($value) == 1) {
				return '00' . ($value + 1);
			} else {
				return '0' . ($value + 1);
			}
		}
	}

	/**
	 * Scope a query to only include most recent consult request
	 * that hasn't been responded to yet.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeInvoices($query)	{
		return $query->where('show_testimonial', '=', 1)
			->orderBy('created_at', 'asc')
			->get();
	}
}
