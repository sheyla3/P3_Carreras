<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Carrera
 * 
 * @property int $id_carrera
 * @property string $nombre
 * @property string $descripcion
 * @property string $tipo
 * @property string $lugar_foto
 * @property int $max_participantes
 * @property int $aforo
 * @property int $km
 * @property Carbon $fechaHora
 * @property string $cartel
 * @property int $patrocinio
 * @property int $precio
 * @property string $qr
 * @property bool $activo
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Sponsor[] $sponsors
 * @property Collection|Foto[] $fotos
 * @property Collection|Participante[] $participantes
 *
 * @package App\Models
 */
class Carrera extends Model
{
	protected $table = 'carreras';
	protected $primaryKey = 'id_carrera';

	protected $casts = [
		'max_participantes' => 'int',
		'aforo' => 'int',
		'km' => 'int',
		'fechaHora' => 'datetime',
		'patrocinio' => 'int',
		'precio' => 'int',
		'activo' => 'bool'
	];

	protected $hidden = [
		'remember_token'
	];

	protected $fillable = [
		'nombre',
		'descripcion',
		'tipo',
		'lugar_foto',
		'max_participantes',
		'aforo',
		'km',
		'fechaHora',
		'cartel',
		'patrocinio',
		'precio',
		'qr',
		'activo',
		'remember_token'
	];

	public function sponsors()
	{
		return $this->belongsToMany(Sponsor::class, '_sponsor_carrera', 'id_carrera', 'id_sponsor')
					->withPivot('id_sponsorCarrera', 'remember_token')
					->withTimestamps();
	}

	public function fotos()
	{
		return $this->hasMany(Foto::class, 'id_carrera');
	}

	public function participantes()
	{
		return $this->hasMany(Participante::class, 'id_carrera');
	}
}