<?php

namespace App\Models;

use App\Models\Traits\Uuid as TraitUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    use TraitUuid;

    protected $fillable = [
        'name',
        'description',
        'is_active'
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected $casts = [
        'id' => 'string',
        'is_active' => 'boolean'
    ];

    public $incrementing = false;
}
