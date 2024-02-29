<?php

namespace App\Models;

use App\Models\Casts\Url;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperUser
 */
class User extends Model
{
    protected $table = 'sm_users';

    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'name',
        'email',
        'email_verified',
        'phone',
        'phone_verified',
        'password',
        'gender',
        'city_id',
        'town_id',
        'professional_id',
        'photo_url',
        'cover_url',
        'active'
    ];

    protected $attributes = [
        'updated_at' => null,
        'email_verified' => false,
        'phone' => null,
        'phone_verified' => false,
        'password' => null,
        'gender' => null,
        'photo_url' => null,
        'cover_url' => null,
        'active' => true,
        'city_id' => null,
        'town_id' => null,
        'professional_id' => null,
    ];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'name' => 'string',
        'email' => 'string',
        'email_verified' => 'boolean',
        'phone' => 'string',
        'phone_verified' => 'boolean',
        'password' => 'string',
        'gender' => 'string',
        'photo_url' => Url::class,
        'cover_url' => Url::class,
        'active' => 'boolean',
        'town_id' => 'integer',
        'city_id' => 'integer',
        'professional_id' => 'integer',
    ];

    protected $hidden = [
        'password',
    ];

    public function professional()
    {
        return $this->belongsTo(Professional::class, 'professional_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(Location::class, 'city_id', 'id');
    }

    public function town()
    {
        return $this->belongsTo(Location::class, 'town_id', 'id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function dealings()
    {
        return $this->hasMany(Dealing::class);
    }

    public function scopeWrap(Builder $query, array $relations = ['city', 'town', 'professional'])
    {
        return $query->with($relations);
    }

    public function scopeWrapped(Builder $query)
    {
        return $query->with(['city', 'town', 'professional' => fn ($q) => $q->with('job')]);
    }

    public function scopeWithLocation(Builder $query)
    {
        return $query->with(['city', 'town']);
    }

    public function scopeHasProfessionnal(Builder $query)
    {
        return $query->whereNotNull('professional_id');
    }

    public function scopeWithProfessionnalInfo(Builder $query)
    {
        return $query->with(['professional' => fn ($b) => $b->withCount('likes')]);
    }

    public function scopeAlreadyExists($query, string $email, string $phone): bool
    {
        return $query->where('email', $email)->orWhere('phone', $phone);
    }
}
