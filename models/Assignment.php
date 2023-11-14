<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    public $table = "auth_assignment";
    protected $fillable = [
        'item_name',
        'user_id',
    ];
}