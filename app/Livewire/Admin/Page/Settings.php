<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Page;

use App\Livewire\Utils\WithModels;
use App\Models\Page;
use Livewire\Component;
use App\Models\PageSetting;
use App\Models\Section;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;

#[Layout('components.layouts.dashboard')]
class Settings extends Component
{
    use LivewireAlert;
    use WithPagination;
    use WithModels;
    public $pageSetting;

    public $colors = ['gray', 'red', 'green', 'blue', 'indigo'];

    #[Rule('nullable')]
    public $selectedColor;

    #[Rule('nullable')]
    public $bg_color;

    public $colorOptions = [100, 200, 300, 400, 500, 600, 700, 800, 900];

    public $fontSizes = ['xs', 'sm', 'base', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '9xl'];

    #[Rule('required')]
    public $page_id;

    #[Rule('required')]
    public $page_type;

    #[Rule('required')]
    public $activity_id;

    #[Rule('required')]
    public $package_id;

    public $type;

    public $layout_type = 'wrap';

    public $layoutTypes = ['wrap', 'row', 'col'];

    public $layout_config = [];

    public $selectedSectionId;

    public $selectedTemplate;

    public $sizing;

    protected $rules = [
        'layout_config.*.type'                        => '',
        'layout_config.*.item_id'                     => '',
        'layout_config.*.order'                       => '',
        'layout_config.*.item_config.status'          => '',
        'layout_config.*.item_config.title'           => '',
        'layout_config.*.item_config.description'     => '',
        'layout_config.*.item_config.link'            => '',
        'layout_config.*.item_config.icon'            => '',
        'layout_config.*.item_style.status'           => '',
        'layout_config.*.item_style.width'            => '',
        'layout_config.*.item_style.height'           => '',
        'layout_config.*.item_style.background_color' => '',
        'layout_config.*.item_style.text_color'       => '',
        'layout_config.*.item_style.font_size'        => '',
        'layout_config.*.item_style.padding'          => '',
        'layout_config.*.item_style.margin'           => '',
        'layout_config.*.item_style.border'           => '',
        'layout_config.*.item_style.border.width'     => '',
        'layout_config.*.item_style.border.color'     => '',
        'layout_config.*.item_style.border.style'     => '',
        'layout_config.*.item_style.border_radius'    => '',
        'layout_config.*.item_style.box_shadow'       => '',
    ];

    #[Computed]
    public function settings()
    {
        return PageSetting::with('page')
            ->paginate(10);
    }

    #[Computed]
    public function sections()
    {
        return Section::select('id', 'title', 'page_id')->get();
    }

    #[Computed]
    public function pages()
    {
        return Page::select('id', 'title')->get();
    }

    public function deleteSection($type, $id, $index): void
    {
        $config = $this->getConfig($type, $id);

        if ( ! $config) {
            // Handle error, configuration not found
            $this->alert('error', 'Configuration not found.');

            return;
        }

        $this->layoutConfig($config, $index);

        unset($this->layout_config[$index]);

        $config->layout_config = json_encode($this->layout_config);

        $config->save();

        $this->alert('success', 'Section deleted successfully.');
    }

    public function getConfig($type, $id)
    {
        return match ($type) {
            'section' => $this->getPageConfig($id),
            'service' => $this->getServiceConfig($id),
            default   => $this->getPageTypeConfig($type),
        };
    }

    private function layoutConfig($config, $index): void
    {
        $this->layout_config = json_decode((string) $config->layout_config, true);
        $this->type = $config->type;

        // if (isset($this->layout_config[$index])) {
        $this->layout_config[$index] = collect($this->layout_config[$index])->mapWithKeys(static function ($value, $key): array {
            $keyMapping = [
                'type'             => 'type',
                'item_id'          => 'item_id',
                'order'            => 'order',
                'status'           => 'item_config.status',
                'title'            => 'item_config.title',
                'description'      => 'item_config.description',
                'link'             => 'item_config.link',
                'icon'             => 'item_config.icon',
                'width'            => 'item_style.width',
                'height'           => 'item_style.height',
                'background_color' => 'item_style.background_color',
                'text_color'       => 'item_style.text_color',
                'font_size'        => 'item_style.font_size',
                'padding'          => 'item_style.padding',
                'margin'           => 'item_style.margin',
                'border_width'     => 'item_style.border.width',
                'border_color'     => 'item_style.border.color',
                'border_style'     => 'item_style.border.style',
                'border_radius'    => 'item_style.border_radius',
                'box_shadow'       => 'item_style.box_shadow',
            ];

            return [$keyMapping[$key] ?? $key => $value];
        })->all();
        // }
    }

    public function reorderSections($sectionIndexes): void
    {
        foreach ($sectionIndexes as $index => $sectionIndex) {
            $this->layout_config[$index]['order'] = $sectionIndex;
        }
    }

    public function editSection($type, $id, $index): void
    {
        $this->pageSetting = $this->getConfig($type, $id);

        if ( ! $this->pageSetting) {
            // Handle error, configuration not found
            $this->alert('error', 'Configuration not found.');

            return;
        }

        $this->fill([
            'layout_config' => json_decode((string) $this->pageSetting->layout_config, true),
            'type'          => $this->pageSetting->type,
        ]);

        // // if (isset($this->layout_config[$index])) {
        // $this->layout_config[$index] = collect($this->layout_config[$index])->mapWithKeys(static function ($value, $key): array {
        //     $keyMapping = [
        //         'type'             => 'type',
        //         'item_id'          => 'item_id',
        //         'order'            => 'order',
        //         'status'           => 'item_config.status',
        //         'title'            => 'item_config.title',
        //         'description'      => 'item_config.description',
        //         'link'             => 'item_config.link',
        //         'icon'             => 'item_config.icon',
        //         'width'            => 'item_style.width',
        //         'height'           => 'item_style.height',
        //         'background_color' => 'item_style.background_color',
        //         'text_color'       => 'item_style.text_color',
        //         'font_size'        => 'item_style.font_size',
        //         'padding'          => 'item_style.padding',
        //         'margin'           => 'item_style.margin',
        //         'border_width'     => 'item_style.border.width',
        //         'border_color'     => 'item_style.border.color',
        //         'border_style'     => 'item_style.border.style',
        //         'border_radius'    => 'item_style.border_radius',
        //         'box_shadow'       => 'item_style.box_shadow',
        //     ];
        //     return [$keyMapping[$key] ?? $key => $value];
        // })->all();
    }

    public function updateSection(): void
    {
        $this->pageSetting->layout_config = json_encode($this->layout_config);
        $this->pageSetting->save();

        $this->alert('success', 'Section updated successfully.');
    }

    public function save(): void
    {
        $this->validate([
            'page_type' => 'required',
            // 'page_id'           => 'required',
            'selectedSectionId' => 'required',
            'layout_type'       => 'required',
        ]);

        // Retrieve the existing PageSetting or create a new one
        $this->pageSetting = PageSetting::updateOrCreate(
            ['page_type' => $this->page_type],
            [
                'page_type'   => $this->page_type,
                'status'      => true,
                'layout_type' => $this->layout_type,
            ]
        );

        if ($this->pageSetting->layout_config) {
            $existingLayoutConfig = json_decode((string) $this->pageSetting->layout_config, true);
            $order_count = count($existingLayoutConfig) + 1;
        }

        if ($this->selectedTemplate) {
            $selectedTemplateStyles = $this->getSelectedTemplateStyles($this->selectedTemplate);

            $newSection = [
                'type'        => 'section',
                'item_id'     => $this->selectedSectionId,
                'order'       => $order_count ?? 1,
                'item_config' => [
                    'status'      => false,
                    'title'       => '',
                    'description' => '',
                    'link'        => '',
                    'icon'        => '',
                ],
                'item_style' => $selectedTemplateStyles,
            ];
        } else {
            $newSection = [
                'type'        => 'section',
                'item_id'     => $this->selectedSectionId,
                'order'       => $order_count ?? 1,
                'item_config' => [
                    'status'      => false,
                    'title'       => '',
                    'description' => '',
                    'link'        => '',
                    'icon'        => '',
                ],
                'item_style' => [
                    'status'           => true,
                    'width'            => $this->sizing,
                    'height'           => '',
                    'background_color' => $this->bg_color,
                    'text_color'       => '',
                    'font_size'        => '',
                    'padding'          => '',
                    'margin'           => '',
                    'border'           => [
                        'width' => '',
                        'color' => '',
                        'style' => '',
                    ],
                    'border_radius' => '',
                    'box_shadow'    => '',
                ],
            ];
        }

        // Append the new section to the existing layout_config
        $existingLayoutConfig[] = $newSection;

        // Update the PageSetting with the merged layout_config
        $this->pageSetting->layout_config = json_encode($existingLayoutConfig);
        $this->pageSetting->save();

        if ($this->pageSetting) {
            $this->alert('success', 'Page setting successfully saved.');
        } else {
            $this->alert('error', 'Failed to save page setting.');
        }
    }

    private function getSelectedTemplateStyles($templateName)
    {
        $templates = $this->templates;

        if (isset($templates[$templateName])) {
            return $templates[$templateName]['styles'];
        }

        return [];
    }

    #[Computed]
    public function templates(): array
    {
        // get template in array format with index as template name
        return [
            [
                'name'   => 'Hero Section',
                'styles' => [
                    'status'           => true,
                    'width'            => 'full',
                    'height'           => 'auto',
                    'background_color' => 'blue',
                    'text_color'       => 'white',
                    'font_size'        => '24px',
                    'padding'          => '20px',
                    'margin'           => '0',
                    'border'           => [
                        'width' => '2px',
                        'color' => 'black',
                        'style' => 'solid',
                    ],
                    'border_radius' => '0',
                    'box_shadow'    => 'none',
                ],
            ],
            [
                'name'   => 'Card Section',
                'styles' => [
                    'status'           => true,
                    'width'            => 'full',
                    'height'           => 'auto',
                    'background_color' => 'white',
                    'text_color'       => 'black',
                    'font_size'        => '16px',
                    'padding'          => '10px',
                    'margin'           => '10px',
                    'border'           => [
                        'width' => '1px',
                        'color' => 'gray',
                        'style' => 'solid',
                    ],
                    'border_radius' => '5px',
                    'box_shadow'    => '0px 2px 4px rgba(0, 0, 0, 0.1)',
                ],
            ],
            [
                'name'   => 'Feature Section',
                'styles' => [
                    'status'           => true,
                    'width'            => 'full',
                    'height'           => 'auto',
                    'background_color' => 'lightgray',
                    'text_color'       => 'black',
                    'font_size'        => '18px',
                    'padding'          => '20px',
                    'margin'           => '0',
                    'border'           => [
                        'width' => '2px',
                        'color' => 'blue',
                        'style' => 'solid',
                    ],
                    'border_radius' => '10px',
                    'box_shadow'    => '0px 4px 8px rgba(0, 0, 0, 0.2)',
                ],
            ],
            [
                'name'   => 'Banner Section',
                'styles' => [
                    'status'           => true,
                    'width'            => 'full',
                    'height'           => '300px',
                    'background_color' => 'green',
                    'text_color'       => 'white',
                    'font_size'        => '24px',
                    'padding'          => '20px',
                    'margin'           => '0',
                    'border'           => [
                        'width' => '0',
                        'color' => 'transparent',
                        'style' => 'none',
                    ],
                    'border_radius' => '0',
                    'box_shadow'    => 'none',
                ],
            ],
            [
                'name'   => 'Testimonial Section',
                'styles' => [
                    'status'           => true,
                    'width'            => 'full',
                    'height'           => 'auto',
                    'background_color' => 'lightblue',
                    'text_color'       => 'black',
                    'font_size'        => '18px',
                    'padding'          => '20px',
                    'margin'           => '0',
                    'border'           => [
                        'width' => '1px',
                        'color' => 'gray',
                        'style' => 'solid',
                    ],
                    'border_radius' => '5px',
                    'box_shadow'    => '0px 2px 4px rgba(0, 0, 0, 0.1)',
                ],
            ],
            [
                'name'   => 'Feature Section',
                'styles' => [
                    'status'           => true,
                    'width'            => 'full',
                    'height'           => 'auto',
                    'background_color' => 'lightgray',
                    'text_color'       => 'black',
                    'font_size'        => '20px',
                    'padding'          => '30px',
                    'margin'           => '0',
                    'border'           => [
                        'width' => '1px',
                        'color' => 'darkgray',
                        'style' => 'solid',
                    ],
                    'border_radius' => '10px',
                    'box_shadow'    => '0px 4px 8px rgba(0, 0, 0, 0.2)',
                ],
            ],
            [
                'name'   => 'Sidebar Section',
                'styles' => [
                    'status'           => true,
                    'width'            => '25',
                    'height'           => '100',
                    'background_color' => '',
                    'text_color'       => 'black',
                    'font_size'        => '20px',
                    'padding'          => '0',
                    'margin'           => '0',
                    'border'           => [
                        'width' => '1px',
                        'color' => 'darkgray',
                        'style' => 'solid',
                    ],
                    'border_radius' => '0',
                    'box_shadow'    => 'none',
                ],
            ],

        ];
    }

    public function selectBgColor($color): void
    {
        $this->bg_color = $color;
    }

    public function selectColor($color): void
    {
        $this->bg_color = $color;
        $this->selectedColor = $color;
    }

    public function delete(PageSetting $setting): void
    {
        $setting->delete();
    }
}
