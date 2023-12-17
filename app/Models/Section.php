<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PageType;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Section extends Model
{
    use HasAdvancedFilter;

    final public const ATTRIBUTES = [
        'id',
        'title',
        'status',
    ];

    public $orderable = self::ATTRIBUTES;

    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'page_id',
        'title',
        'featured_title',
        'subtitle',
        'text',
        'bg_color',
        'text_color',
        'type',
        'position',
        'label',
        'link',
        'image',
        'description',
        'embeded_video',
        'status',
        'language_id',
    ];

    protected $casts = [
        'type'   => PageType::class,
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

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
