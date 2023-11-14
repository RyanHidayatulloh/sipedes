<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuthItem extends Model
{
    public $table = "auth_item";
    protected $fillable = [
        'name',
        'type',
        'description',
        'rule_name',
        'data',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Assignment::class, 'item_name', 'name');
    }
}