<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recommendation extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	/**
	 * Get the consult contact record associated with the recommendation.
	 */
	public function consultContact()	{
		return $this->belongsTo('App\ConsultContact');
	}

	/**
	 * Scope a query to only include most recent consult request
	 * that hasn't been responded to yet.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeShowTestimonials($query)	{
		return $query->where('show_testimonial', '=', 1)
			->orderBy('created_at', 'asc')
			->get();
	}
}
