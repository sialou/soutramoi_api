<?php

namespace App\Models;

use App\Models\Casts\Url;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperMedia
 */
class Media extends Model
{
    protected $table = 'sm_medias';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'type',
        'hash',
        'name',
        'assignment',
        'url',
        'user_id',
    ];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'type' => 'string',
        'hash' => 'string',
        'name' => 'string',
        'assignment' => 'string',
        'url' => Url::class,
        'user_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
