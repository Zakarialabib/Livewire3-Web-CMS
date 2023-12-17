<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Status;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasAdvancedFilter;

    final public const ATTRIBUTES = [
        'id',
        'title',
        'slug',
        'status',
        'featured',
    ];

    public $orderable = self::ATTRIBUTES;

    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'title',
        'description',
        'image',
        'slug',
        'status',
        'featured',
        'meta_title',
        'meta_description',
        'language_id',
        'category_id',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function scopeActive($query): void
    {
        $query->where('status', true);
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

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

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
