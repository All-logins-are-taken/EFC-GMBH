<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    public const  ADVERTISEMENT_PER_PAGE = 10;

    protected $table = 'advertisements';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'posting_date'
    ];

    protected $casts = [
        'posting_date' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($advertisement) {
            $advertisement->posting_date = now();
        });
    }

    public $timestamps = false;

    public function images(): HasMany
    {
        return $this->hasMany(AdvertisementImage::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
