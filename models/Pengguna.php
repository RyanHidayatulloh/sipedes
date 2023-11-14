<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the model class for table "pengguna".
 * 
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $verification_token
 */

class Pengguna extends Model
{
    public $table = "user";
    protected $fillable = [
        'nik',
        'name',
        'auth_key',
        'password_hash',
        'password_reset_token',
        'email',
        'status',
        'created_at',
        'updated_at',
        'verification_token',
    ];
}