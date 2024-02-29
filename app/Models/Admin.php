<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Admin
 * 
 * @property int $id_admin
 * @property string $usuario
 * @property string $contrasena
 * @property string|null $firma
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Admin extends Model
{
	protected $table = 'admin';
	protected $primaryKey = 'id_admin';

	protected $hidden = [
		'remember_token'
	];

	protected $fillable = [
		'usuario',
		'contrasena',
		'firma',
		'remember_token'
	];
}
