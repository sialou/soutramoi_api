<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperProfessional
 */
class Abonnement extends Model
{
    protected $table = 'sm_abonnements';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'created_at',
        'user_id',
        'job_id',
        'type_abonnement',

    ];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'date',
        'user_id' => 'integer',
        'job_id' => 'integer',
        'type_abonnement' => 'string',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function job()
    {
        return $this->belongsTo(User::class, 'job_id', 'id');
    }
}
