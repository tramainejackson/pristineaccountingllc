<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultResponse extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['response'];

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
	public function consultRequest()	{
		return $this->belongsTo('App\ConsultRequest');
	}

	/**
	 * Scope a query to only include most recent consult request
	 * that hasn't been responded to yet.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeLeastRecent($query)	{
		return $query->where('responded', '=', 'N')
					 ->orderBy('created_at', 'asc')
					 ->get();
	}
}
