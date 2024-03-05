<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Jinete
 * 
 * @property int $id_jinete
 * @property string $nombre
 * @property string $apellido
 * @property string $correo
 * @property string $contrasena
 * @property int $telf
 * @property string $calle
 * @property int $num_federat
 * @property Carbon $edad
 * @property bool $activo
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Caballo[] $caballos
 * @property Collection|Participante[] $participantes
 *
 * @package App\Models
 */
class Jinete extends Model
{
	protected $table = 'jinetes';
	protected $primaryKey = 'id_jinete';

	protected $casts = [
		'telf' => 'int',
		'num_federat' => 'int',
		'edad' => 'datetime',
		'activo' => 'bool'
	];

	protected $hidden = [
		'remember_token'
	];

	protected $fillable = [
		'nombre',
		'apellido',
		'correo',
		'contrasena',
		'telf',
		'calle',
		'num_federat',
		'edad',
		'activo',
		'remember_token'
	];

	public function caballos()
	{
		return $this->hasMany(Caballo::class, 'id_jinete');
	}

	public function participantes()
	{
		return $this->hasMany(Participante::class, 'id_jinete');
	}
}