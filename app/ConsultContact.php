<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

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
	 * Get the contacts phone number.
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
	 * Get the contacts avatar.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public function getAvatarAttribute($value) {
		$value != null ? $member_image = $value : $member_image = 'default';

		// Check if file exist
		$img_file = Storage::disk('public')->exists('images/' . $member_image);

		if($img_file) {
			return $img_file = $member_image;
		} else {
			return $img_file = 'default.png';
		}
	}

	/**
	 * Save the contacts avatar.
	 *
	 * @param  image/file  $avatar
	 * @param  string  $file_name
	 * @return array
	 */
	public function create_avatar($avatar_file, $file_name) {
		$error      = '';
		$fileName   = '';
		$newImage   = $avatar_file;

		// Check to see if upload is an image
		if ($newImage->guessExtension() == 'jpeg' || $newImage->guessExtension() == 'png' || $newImage->guessExtension() == 'gif' || $newImage->guessExtension() == 'webp' || $newImage->guessExtension() == 'jpg') {

			// Check to see if images is too large
			if ($newImage->getError() == 1) {
				$fileName = $newImage[0]->getClientOriginalName();
				$error .= $fileName . " is too large and could not be uploaded";
			} elseif ($newImage->getError() == 0) {
				// Check to see if images is about 25MB
				// If it is then resize it
				if ($newImage->getClientSize() < 25000000) {
					$image = Image::make($newImage->getRealPath())->orientate();
				    // $path = $newImage->store('public/images');
					$image_ext = substr($image->mime(), '6');

					// Create a smaller version of the image
					// and save to large image folder
					$image->resize(300, null, function ($constraint) {
						$constraint->aspectRatio();
					});

					if ($image->save(storage_path('app/public/images/' . $file_name . '_sm.' . $image_ext))) {
						$file_name = $file_name . '_sm.' . $image_ext;
					}

				} else {
					// Resize the image before storing. Will need to hash the filename first
					$path = $newImage->store('public/images');
					$image = Image::make($newImage)->orientate()->resize(1600, null, function ($constraint) {
						$constraint->aspectRatio();
						$constraint->upsize();
					});
					$image->save(storage_path('app/' . $path));
				}
			} else {
				$error .= $fileName . " may be corrupt and could not be uploaded";
			}

			// Return name to be saved to db
			return array('success', $file_name);

		} else {
			// Upload is not an image.
			// Redirect with error
			return $error .= $fileName . " may be corrupt and could not be uploaded";
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
