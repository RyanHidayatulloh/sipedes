<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wilayah extends Model
{
    public $table = "wilayah";
    protected $fillable = [
        'kode', 'name',
    ];
}