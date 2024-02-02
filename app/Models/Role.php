<?php

namespace App\Models;

use App\Models\Enums\Roles;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'id' => 'string',
        'name' => Roles::class,
    ];

    public static function admin(): self
    {
        return self::where('name', Roles::ADMIN)->firstOrFail();
    }

    public static function editor(): self
    {
        return self::where('name', Roles::EDITOR)->firstOrFail();
    }
}
