<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PageType;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageSetting extends Model
{
    use HasFactory;

    public $table = 'pagesettings';

    protected $fillable = [
        'status',
        'page_id',
        'page_type',
        'layout_type',
        'layout_config',
    ];

    protected $casts = [
        'status'        => Status::class,
        'page_type'     => PageType::class,
        'layout_config' => 'json',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }
}
