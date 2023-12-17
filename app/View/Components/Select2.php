<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;

class Select2 extends Component
{
    public function __construct(public $name, public $id, public $options, public $selected = null, public $multiple = false, public $searchable = false)
    {
    }

    public function render()
    {
        return view('components.select2');
    }
}
