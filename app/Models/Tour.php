<?php

namespace App\Models;

use App\Data\Value\Price;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tour extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

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

    /**
     * @return BelongsTo<Travel,Tour>
     */
    public function travel(): BelongsTo
    {
        return $this->belongsTo(Travel::class);
    }

    /**
     * @phpstan-ignore-next-line
     */
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Price::from($value)->fromCents(),
            set: fn ($value) => Price::from($value)->toCents(),
        );
    }
}
