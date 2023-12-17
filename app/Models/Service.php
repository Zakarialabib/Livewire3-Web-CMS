<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\Status;

class Service extends Model
{
    use HasAdvancedFilter;
    use HasFactory;

    final public const ATTRIBUTES = [
        'id',
        'title',
        'status',
        'type',
    ];

    public $orderable = self::ATTRIBUTES;

    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'title',
        'image',
        'content',
        'features',
        'options',
        'slug',
        'status',
        'type',
        'language_id',
    ];

    protected $casts = [
        'options'  => 'json',
        'features' => 'json',
        'status'   => Status::class,
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
