<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperAccessToken
 */
class AccessToken extends Model
{
    public $timestamps = false;

    protected $table = 'sm_authentication_accesstokens';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'user_id',
        'email',
        'phone',
        'token',
        'expires',
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'email' => 'string',
        'phone' => 'string',
        'token' => 'string',
        'expires' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isValid()
    {
        return $this->expires > time();
    }

    public static function make(int $userId)
    {
        $token = static::where('user_id', $userId)->first();

        if (!$token || $token->expires < time()) {
            if ($token) {
                $token->delete();
            }

            $token = new static();
            $token->user_id = $userId;
            $token->token = bin2hex(random_bytes(32));
            $token->expires = time() + (60 * 60 * 24 * 183); // 183 days
            $token->save();
        }

        return $token;
    }
}
