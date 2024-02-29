<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Caballo
 * 
 * @property int $id_caballo
 * @property int $id_jinete
 * @property string $nombre
 * @property string $raza
 * @property string $color
 * @property Carbon $edad
 * @property Carbon $años_participando
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Jinete $jinete
 *
 * @package App\Models
 */
class Caballo extends Model
{
	protected $table = 'caballo';
	protected $primaryKey = 'id_caballo';

	protected $casts = [
		'id_jinete' => 'int',
		'edad' => 'datetime',
		'años_participando' => 'datetime'
	];

	protected $hidden = [
		'remember_token'
	];

	protected $fillable = [
		'id_jinete',
		'nombre',
		'raza',
		'color',
		'edad',
		'años_participando',
		'remember_token'
	];

	public function jinete()
	{
		return $this->belongsTo(Jinete::class, 'id_jinete');
	}
}
