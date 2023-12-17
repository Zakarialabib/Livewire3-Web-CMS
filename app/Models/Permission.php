<?php

declare(strict_types=1);

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasFactory;
    use HasAdvancedFilter;

    public $table = 'permissions';

    public $orderable = [
        'id',
        'name',
        'guard_name',
        'created_at',
        'updated_at',
    ];

    public $filterable = [
        'id',
        'name',
        'guard_name',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'guard_name',
        'created_at',
        'updated_at',
    ];
}
