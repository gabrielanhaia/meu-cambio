<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskControl extends Model
{
    /** @var string $table Nome da tabela vinculada a model. */
    protected $table = 'task_control';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'last_execution'
    ];

    /** @var array $fillable */
    protected $fillable = [
        'name',
        'last_execution',
    ];
}
