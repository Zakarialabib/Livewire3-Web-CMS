<?php

declare(strict_types=1);

namespace App\Livewire\Utils;

use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\WithPagination;

trait Datatable
{
    use WithPagination;

    public int $perPage = 25;

    /** @param array<string> $orderable */
    public array $orderable;

    #[Url(keep: true)]
    public string $search = '';

    /** @param array<string> $selected */
    public array $selected = [];

    /** @param array<int> $paginationOptions */
    public array $paginationOptions;

    public bool $selectPage = false;

    public string $sortBy = '';

    public string $sortDirection = '';

    public function mountDatatable(): void
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->paginationOptions = [25, 50, 100];
    }

    public function sortBy($field): void
    {
        $this->sortBy = $field;

        $this->sortDirection = $this->sortBy === $field
            ? $this->reverseSort()
            : 'asc';
    }

    public function reverseSort(): string
    {
        return $this->sortDirection === 'asc'
            ? 'desc'
            : 'asc';
    }

    #[Computed]
    public function selectedCount(): int
    {
        return count($this->selected);
    }

    public function resetSelected(): void
    {
        $this->selected = [];
    }

    protected $queryString = [
        'search',
        'sortBy',
        'sortDirection',
    ];

    #[On('refreshIndex')]
    public function refreshIndex(): void
    {
        $this->resetPage();
    }
}
