<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PageType;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    use HasAdvancedFilter;

    final public const ATTRIBUTES = [
        'id',
        'id', 'name',
        'email', 'phone_number',
        'subject', 'message',
        'type',
    ];

    public $orderable = self::ATTRIBUTES;

    public $filterable = self::ATTRIBUTES;

    protected $fillable = [
        'id', 'name', 'email', 'phone_number', 'subject', 'message',
        'type',
    ];

    protected $casts = [
        'type' => PageType::class,
    ];
}
