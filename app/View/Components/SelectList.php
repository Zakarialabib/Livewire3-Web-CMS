<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;

class SelectList extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  mixed  $id
     */
    public function __construct(public mixed $options)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.select-list');
    }
}
