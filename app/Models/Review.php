<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperReview
 */
class Review extends Model
{
    public $incrementing = true;

    protected $table = 'sm_reviews';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'rating',
        'comment',
        'user_id',
        'professional_id',
    ];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'rating' => 'integer',
        'comment' => 'string',
        'user_id' => 'integer',
        'professional_id' => 'integer',
    ];

    protected $attributes = [
        'updated_at' => null,
        'rating' => null,
    ];

    protected $hidden = [
        'user_id',
        'professional_id',
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
