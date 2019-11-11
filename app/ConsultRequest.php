<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultRequest extends Model
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
	 * Scope a query to only include most recent consult request
	 * that hasn't been responded to yet.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeMostRecent($query)	{
		return $query->where('responded', '=', 'N')
					 ->orderBy('created_at', 'desc')
					 ->get();
	}
}
