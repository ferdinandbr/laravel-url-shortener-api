<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;
    protected $table = 'urls';

    protected $fillable = [
        'url',
        'identifier',
        'short_url',
        'expiration'
    ];

    protected $hidden = [
      'id',
      'updated_at'
    ];

    protected $dates = [
      'deleted_at'
    ];
}