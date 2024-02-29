<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperLocation
 */
class Location extends Model
{
    public $timestamps = false;

    protected $table = 'sm_locations';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'slug',
        'active',
        'parent_id',
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'active' => 'boolean',
        'parent_id' => 'integer',
    ];

    protected $attributes = [
        'active' => true,
        'parent_id' => null,
    ];

    protected $hidden = [
        'active',
        // 'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(Location::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Location::class, 'parent_id');
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
