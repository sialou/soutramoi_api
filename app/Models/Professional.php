<?php

namespace App\Models;

use App\Models\Casts\Concatenable;
use App\Models\Casts\GeoData;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperProfessional
 */
class Professional extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $table = 'sm_professionals';

    protected $fillable = [
        'id',
        'job_id',
        'geolocation',
        'services',
        'products',
        'address',
        'company_name',
        'description',
        'approved',
    ];

    protected $casts = [
        'id' => 'integer',
        'job_id' => 'integer',
        'description' => 'string',
        'services' => Concatenable::class,
        'products' => Concatenable::class,
        'address' => 'string',
        'company_name' => 'string',
        'geolocation' => GeoData::class,
        'approved' => 'boolean',
    ];

    protected $attributes = [
        'id' => null,
        'job_id' => null,
        'geolocation' => null,
        'services' => null,
        'products' => null,
        'address' => null,
        'company_name' => null,
        'description' => null,
        'approved' => false,
    ];

    protected $hidden = [
        'approved',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'professional_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'professional_id');
    }
}
