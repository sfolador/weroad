<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Travel extends Model
{
    use HasFactory,HasSlug,HasUuids, SoftDeletes;

    protected $table = 'travels';

    protected $fillable = [
        'slug',
        'name',
        'description',
        'numberOfDays',
        'public',
    ];

    protected static function booted(): void
    {
        static::creating(function (Travel $travel) {
            $travel->numberOfNights = $travel->numberOfDays - 1;
        });

        static::updating(function (Travel $travel) {
            $travel->numberOfNights = $travel->numberOfDays - 1;
        });
    }

    protected $casts = [
        'id' => 'string',
    ];

    /**
     * @return BelongsToMany<Mood>
     */
    public function moods(): BelongsToMany
    {
        return $this->belongsToMany(Mood::class, 'moods_travels')->withPivot('value');
    }

    public function isPublic(): bool
    {
        return $this->public;
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
