<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;

/**
 * Model que representa as publicações do feed.
 * @package App\Models\V1
 */
class NewFeed extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'publication_date'
    ];

    /** @var string $table Nome da tabela. */
    protected $table = 'news';

    /** @var array $fillable */
    protected $fillable = [
        'title',
        'link',
        'guid',
        'description',
        'publication_date',
        'category'
    ];
}
