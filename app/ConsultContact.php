<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultContact extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	/**
	 * Create full name accessor
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function full_name()	{
		return $this->first_name . " " . $this->last_name;
	}

	/**
	 * Get the consult request record associated with the user.
	 */
	public function consultRequest() {
		return $this->belongsTo('App\ConsultRequest');
	}

	/**
	 * Get the consult request record associated with the user.
	 */
	public function recommendation() {
		return $this->hasMany('App\Recommendation');
	}

	/**
	 * Get the user's phone number.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function getPhoneAttribute($value) {
		if($value == null) {
			return 'No Phone Number Listed';
		} else {
			return ucfirst($value);
		}
	}

	/**
	 * Scope a query to only include most recent consult request
	 * that hasn't been responded to yet.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeSurveyId($query, $survey_id)	{
		return $query->where('survey_id', '=', $survey_id)
			->get();
	}

}
