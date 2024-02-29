<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperLike
 */
class Like extends Model
{
    protected $table = 'sm_likes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'created_at',
        'user_id',
        'professional_id',
    ];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'user_id' => 'integer',
        'professional_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function professional()
    {
        return $this->belongsTo(Professional::class, 'professional_id', 'user_id');
    }
}
