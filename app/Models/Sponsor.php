<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sponsor
 * 
 * @property int $id_sponsor
 * @property string $CIF
 * @property string $nombre
 * @property string $logo
 * @property string $calle
 * @property string $destacado
 * @property bool $activo
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Carrera[] $carreras
 *
 * @package App\Models
 */
class Sponsor extends Model
{
	protected $table = 'sponsor';
	protected $primaryKey = 'id_sponsor';

	protected $casts = [
		'activo' => 'bool'
	];

	protected $hidden = [
		'remember_token'
	];

	protected $fillable = [
		'CIF',
		'nombre',
		'logo',
		'calle',
		'destacado',
		'activo',
		'remember_token'
	];

	public function carreras()
	{
		return $this->belongsToMany(Carrera::class, '_sponsor_carrera', 'id_sponsor', 'id_carrera')
					->withPivot('id_sponsorCarrera', 'remember_token')
					->withTimestamps();
	}
}
