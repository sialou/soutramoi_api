<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requete extends Model
{
    use HasFactory;

    protected $fillable=['user_id',	'job_id',	'hour',	'day',	'type',	'description',	'created_at'];


}
