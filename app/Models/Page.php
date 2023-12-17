<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PageType;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasAdvancedFilter;
    use HasFactory;

    final public const ATTRIBUTES = [
        'id', 'title', 'slug',
        'type',
    ];

    public $orderable = self::ATTRIBUTES;

    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'title', 'slug', 'description',
        'meta_title', 'meta_description',
        'status', 'images', 'type',
        'settings', 'language_id',
    ];

    protected $casts = [
        'satuts'   => Status::class,
        'type'     => PageType::class,
        'settings' => 'array',
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
