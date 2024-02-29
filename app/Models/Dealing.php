<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperDealing
 */
class Dealing extends Model
{
    protected $table = 'sm_dealings';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'created_at',
        'work',
        'user_id',
        'professional_id',
    ];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'work' => 'string',
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
