<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SponsorCarrera
 * 
 * @property int $id_sponsorCarrera
 * @property int $id_carrera
 * @property int $id_sponsor
 * @property int $patrocinio
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Carrera $carrera
 * @property Sponsor $sponsor
 *
 * @package App\Models
 */
class SponsorCarrera extends Model
{
	protected $table = '_sponsor_carrera';
	protected $primaryKey = 'id_sponsorCarrera';

	protected $casts = [
		'id_carrera' => 'int',
		'id_sponsor' => 'int',
		'patrocinio' => 'int'
	];

	protected $hidden = [
		'remember_token'
	];

	protected $fillable = [
		'id_carrera',
		'id_sponsor',
		'patrocinio',
		'remember_token'
	];

	public function carrera()
	{
		return $this->belongsTo(Carrera::class, 'id_carrera');
	}

	public function sponsor()
	{
		return $this->belongsTo(Sponsor::class, 'id_sponsor');
	}

	public static function SponsorCarreras($id)
	{
		return self::where('id_carrera', $id)->with('carrera')->get();
	}
}
