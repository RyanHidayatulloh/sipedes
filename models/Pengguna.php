<?php

namespace app\models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yii;
use yii\helpers\Url;

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

    use SoftDeletes;
    public $table = "user";
    protected $fillable = [
        'nid',
        'name',
        'auth_key',
        'password_hash',
        'password_reset_token',
        'email',
        'picture',
        'status',
        'created_at',
        'updated_at',
        'verification_token',
    ];
    

    protected function password_hash(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => Yii::$app->security->generatePasswordHash($value),
        );
    }
    protected function picture(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => Url::to("@web/uploads/foto/$value"),
        );
    }
    protected function completed(): Attribute
    {
        return Attribute::make(
            get: fn() => !in_array(true, collect($this->biodata->getFillable())->map(fn($key) => empty($this->biodata->$key))->toArray()),
        );
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class, 'user_id', 'id');
    }

    public function biodata(): HasOne
    {
        return $this->hasOne(Penduduk::class, 'id_user', 'id');
    }
}
