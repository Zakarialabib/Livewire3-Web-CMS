<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\HasAdvancedFilter;

class Language extends Model
{
    use HasAdvancedFilter;

    public $table = 'languages';

    final public const STATUS_ACTIVE = 1;

    final public const STATUS_INACTIVE = 0;

    final public const IS_DEFAULT = 1;

    final public const IS_NOT_DEFAULT = 0;

    final public const ATTRIBUTES = [
        'id',
        'name',
        'status',
    ];

    public $orderable = self::ATTRIBUTES;

    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'name',
        'code',
        'status',
        'is_default',
    ];
}
