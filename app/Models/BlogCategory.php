<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasAdvancedFilter;

    final public const BCATEGORY_ACITVE = 1;

    final public const BCATEGORY_INACTIVE = 0;

    public $orderable = [
        'id',
        'title',
        'status',

    ];

    public $filterable = [
        'id',
        'name',
        'status',

    ];

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'meta_title',
        'meta_description',
        'featured',
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function setSlugAttribute($value): void
    {
        $this->attributes['slug'] = str_replace(' ', '-', (string) $value);
    }
}
