<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tour extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'travel_id',
        'name',
        'startingDate',
        'endingDate',
        'price',
    ];

    protected $casts = [
        'id' => 'string',
        'travel_id' => 'string',
        'startingDate' => 'date',
        'endingDate' => 'date',
    ];
}
