<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Aseguradora
 * 
 * @property int $id
 * @property string $CIF
 * @property string $nombre
 * @property string $calle
 * @property int $precio
 * @property bool $activo
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Aseguradora extends Model
{
	protected $table = 'aseguradoras';

	protected $casts = [
		'precio' => 'int',
		'activo' => 'bool'
	];

	protected $hidden = [
		'remember_token'
	];

	protected $fillable = [
		'CIF',
		'nombre',
		'calle',
		'precio',
		'activo',
		'remember_token'
	];
}
