<?php

declare(strict_types=1);

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

use App\Support\HasAdvancedFilter;

class Role extends SpatieRole
{
    use HasAdvancedFilter;

    final public const ATTRIBUTES = [
        'id',
        'name',
        'guard_name',
    ];

    public $orderable = self::ATTRIBUTES;

    public $filterable = self::ATTRIBUTES;
}
