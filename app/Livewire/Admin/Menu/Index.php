<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Menu;

use App\Models\Menu;
use App\Models\Page;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.dashboard')]
class Index extends Component
{
    use WithPagination;
    use LivewireAlert;
    public int $perPage = 100;

    public $links = [];

    public $menu;

    public $menus;

    public $name;

    public $label;

    public $url;

    public $type;

    public $selectedMenu;

    public $placement = 'header';

    public $parent_id;

    public $new_window = false;

    protected $rules = [
        'menus.*.name'       => 'required',
        'menus.*.type'       => 'required',
        'menus.*.placement'  => 'nullable',
        'menus.*.label'      => 'required',
        'menus.*.url'        => 'required',
        'menus.*.parent_id'  => 'nullable',
        'menus.*.new_window' => 'nullable',
    ];

    public function mount(): void
    {
        $this->menus = Menu::when($this->placement, function ($query): void {
            $query->where('placement', $this->placement);
        })->orderBy('sort_order')
            ->get()->toArray();

        $this->links = Page::select('slug')->get()->toArray();

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function filterByPlacement($value): void
    {
        $this->placement = $value;
        $this->mount();
    }

    public function clone(): void
    {
        $menu = Menu::find($this->selectedMenu);

        Menu::create([
            'name'       => $menu->name,
            'type'       => $menu->type,
            'placement'  => $this->placement,
            'label'      => $menu->label,
            'url'        => $menu->url,
            'parent_id'  => $menu->parent_id,
            'new_window' => $menu->new_window,
        ]);

        $this->alert('success', __('Menu cloned successfully.'));
    }

    public function render()
    {
        $menus = Menu::when($this->placement, function ($query): void {
            $query->where('placement', $this->placement);
        })->paginate($this->perPage);

        return view('livewire.admin.menu.index', ['menus' => $menus]);
    }

    public function update($id, $index): void
    {
        $this->menu = Menu::find($id);

        $this->validate();

        $this->menu->update([
            'name'       => $this->menus[$index]['name'],
            'type'       => $this->menus[$index]['type'],
            'placement'  => $this->menus[$index]['placement'],
            'label'      => $this->menus[$index]['label'],
            'url'        => $this->menus[$index]['url'],
            'parent_id'  => $this->menus[$index]['parent_id'],
            'new_window' => $this->menus[$index]['new_window'],
        ]);

        $this->alert('success', __('Menu updated successfully.'));

        $this->reset(['name', 'label', 'url', 'type', 'placement', 'parent_id', 'new_window']);
    }

    public function store(): void
    {
        $this->validate([
            'name'       => 'required',
            'type'       => 'required',
            'placement'  => 'required',
            'label'      => 'required',
            'url'        => 'required',
            'parent_id'  => 'nullable',
            'new_window' => 'nullable',
        ]);

        $menu = new Menu();
        $menu->name = $this->name;
        $menu->label = $this->label;
        $menu->type = $this->type;
        $menu->placement = $this->placement;
        $menu->url = $this->url;
        $menu->parent_id = $this->parent_id ?? null;
        $menu->new_window = $this->new_window ?? false;
        // Add any additional fields you have in your menu model

        $menu->save();

        $this->reset(['name', 'label', 'url', 'type', 'placement', 'parent_id', 'new_window']);

        $this->alert('success', __('Menu created successfully.'));

        $this->mount();
    }

    public function updateMenuOrder($ids): void
    {
        foreach ($ids as $index => $id) {
            $menu = Menu::find($id);
            $menu->sort_order = $index + 1;
            $menu->save();
        }

        $this->mount();
        $this->alert('success', __('Menu order updated successfully.'));
    }

    public function predefinedMenu(): void
    {
        $this->menus = [
            [
                'name'       => 'Home',
                'type'       => 'route',
                'label'      => 'Home',
                'url'        => 'home',
                'parent_id'  => null,
                'new_window' => false,
            ],
            [
                'name'       => 'About',
                'type'       => 'route',
                'label'      => 'About',
                'url'        => 'about',
                'parent_id'  => null,
                'new_window' => false,
            ],
            [
                'name'       => 'Contact',
                'type'       => 'route',
                'label'      => 'Contact',
                'url'        => 'contact',
                'parent_id'  => null,
                'new_window' => false,
            ],
            [
                'name'       => 'Login',
                'type'       => 'route',
                'label'      => 'Login',
                'url'        => 'login',
                'parent_id'  => null,
                'new_window' => false,
            ],
            [
                'name'       => 'Register',
                'type'       => 'route',
                'label'      => 'Register',
                'url'        => 'register',
                'parent_id'  => null,
                'new_window' => false,
            ],
        ];

        // create the menus
        foreach ($this->menus as $menu) {
            Menu::create($menu);
        }

        $this->mount();
        $this->alert('success', __('Predefined menus created successfully.'));
    }

    public function delete(Menu $menu): void
    {
        // abort_if(Gate::denies('menu_delete'), 403);

        $menu->delete();
        $this->mount();
        $this->alert('success', __('Menu deleted successfully.'));
    }
}
