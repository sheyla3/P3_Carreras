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
 * @property int $precio
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
		'precio',
		'activo',
		'remember_token'
	];

	public function sponsors()
	{
		return $this->belongsToMany(Sponsor::class, '_sponsor_carrera', 'id_carrera', 'id_sponsor')->withPivot('id_sponsorCarrera', 'patrocinio', 'remember_token')
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

	public static function carrerasPost()
	{
		$fechaActual = Carbon::now()->toDateString();
		return self::whereDate('fechaHora', '>', $fechaActual)->where('activo', true)->get();
	}

	public static function carrerasPostPag()
	{
		$fechaActual = Carbon::now()->toDateString();
		return self::whereDate('fechaHora', '>', $fechaActual)->where('activo', true)->paginate(5);
	}

	public static function carrerasAntiguas()
	{
		$fechaActual = Carbon::now()->toDateString();
		return self::whereDate('fechaHora', '<', $fechaActual)->where('activo', true)->get();
	}

	public static function carrerasAntiguasPag()
	{
		$fechaActual = Carbon::now()->toDateString();
		return self::whereDate('fechaHora', '<', $fechaActual)->where('activo', true)->paginate(5);
	}
}
