<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Participante
 * 
 * @property int $id_participante
 * @property int $id_carrera
 * @property int $id_jinete
 * @property int $num_partcipante
 * @property string|null $dorsal
 * @property string|null $qr
 * @property Carbon|null $tiempo
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Carrera $carrera
 * @property Jinete $jinete
 *
 * @package App\Models
 */
class Participante extends Model
{
	protected $table = 'participantes';
	protected $primaryKey = 'id_participante';

	protected $casts = [
		'id_carrera' => 'int',
		'id_jinete' => 'int',
		'num_partcipante' => 'int',
		'tiempo' => 'datetime'
	];

	protected $hidden = [
		'remember_token'
	];

	protected $fillable = [
		'id_carrera',
		'id_jinete',
		'num_partcipante',
		'dorsal',
		'qr',
		'tiempo',
		'remember_token'
	];

	public function carrera()
	{
		return $this->belongsTo(Carrera::class, 'id_carrera');
	}

	public function jinete()
	{
		return $this->belongsTo(Jinete::class, 'id_jinete');
	}
}
