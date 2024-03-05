<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperProfessional
 */
class Requete extends Model
{
    protected $table = 'sm_requete';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'created_at',
        'user_id',
        'job_id',
        'hour',
        'day',
        'type',
        'description',
    ];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'date',
        'user_id' => 'integer',
        'job_id' => 'integer',
        'hour' => 'time',
        'day' => 'date',
        'type' => 'string',
        'description' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function job()
    {
        return $this->belongsTo(User::class, 'job_id', 'id');
    }

    /*public function professional()
    {
        return $this->belongsTo(Professional::class, 'professional_id', 'user_id');
    }*/
}
