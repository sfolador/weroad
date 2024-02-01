<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Travel extends Model
{
    use HasFactory,HasUuids,SoftDeletes;

    protected $table = 'travels';

    protected $fillable = [
        'slug',
        'name',
        'description',
        'numberOfDays',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public function moods(): BelongsToMany
    {
        return $this->belongsToMany(Mood::class)->withPivot('value');
    }
}
