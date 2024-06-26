<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 * 
 * @property int $id_usuario
 * @property string $correo
 * @property string $contrasena
 * @property string $nombre
 * @property string $apellido
 * @property int $telf
 * @property string $dni
 * @property Carbon $edad
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Usuario extends Model
{
	protected $table = 'usuario';
	protected $primaryKey = 'id_usuario';

	protected $casts = [
		'telf' => 'int',
		'edad' => 'datetime'
	];

	protected $hidden = [
		'remember_token'
	];

	protected $fillable = [
		'correo',
		'contrasena',
		'nombre',
		'apellido',
		'telf',
		'dni',
		'edad',
		'remember_token'
	];

	public static function loginUsuario($email)
	{
		return self::where('correo', $email)->first();
	}
}
