<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;

class Slider extends Model
{
    use HasAdvancedFilter;

    public $table = 'sliders';

    final public const ATTRIBUTES = [
        'id', 'title', 'status',
    ];

    public $orderable = self::ATTRIBUTES;

    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'title', 'subtitle', 'description', 'embeded_video',
        'image', 'featured', 'link',  'bg_color', 'status',
        'language_id',
    ];

    protected $casts = [
        'satuts' => Status::class,
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($section) {
            // If the language_id is not set, set it to the current application locale
            if ( ! $section->language_id) {
                $language = Language::where('is_default', true)->first();

                if ($language) {
                    $section->language_id = $language->id;
                }
            }
        });
    }

    public function scopeActive($query): void
    {
        $query->where('status', true);
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
