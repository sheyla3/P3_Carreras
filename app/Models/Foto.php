<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Foto
 * 
 * @property int $id_foto
 * @property int $id_carrera
 * @property string $foto
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Carrera $carrera
 *
 * @package App\Models
 */
class Foto extends Model
{
	protected $table = 'fotos';
	protected $primaryKey = 'id_foto';

	protected $casts = [
		'id_carrera' => 'int'
	];

	protected $hidden = [
		'remember_token'
	];

	protected $fillable = [
		'id_carrera',
		'foto',
		'remember_token'
	];

	public function carrera()
	{
		return $this->belongsTo(Carrera::class, 'id_carrera');
	}

	public static function FotoCarrera($id)
	{
		return self::where('id_carrera', $id)->with('carrera')->get();
	}

	public static function ELiminarFotos($id)
	{
		return self::where('id_carrera', $id)->get();
	}
}
