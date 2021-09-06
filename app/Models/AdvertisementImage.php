<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class AdvertisementImage extends Model
{
    use HasFactory;

    protected $table = 'advertisement_images';

    protected $appends = ['url'];

    public $fillable = [
        'advertisement_id',
        'image_name',
        'image_path',
    ];

    public $timestamps = false;

    public function getUrlAttribute(): string
    {
        return Storage::url($this->path);
    }

    public static function saveImages($request, $advertisement): void
    {
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $image) {
                $imageName = time() . $image->getClientOriginalName();
                $imagePath = $image->storeAs('images', $imageName, 'public');

                $advertisement->images()->create([
                    'image_name' => $imageName,
                    'image_path' => $imagePath,
                ]);
            }
        }
    }

    public function advertisement(): BelongsTo
    {
        return $this->belongsTo(Advertisement::class);
    }
}
