<?php

namespace App\Support\View\EntityColumns;

use Illuminate\Contracts\Support\Jsonable;

abstract class TableConfig implements Jsonable
{
    protected $searchEnabled = true;

    protected $editEnabled = true;

    protected $deleteEnabled = true;

    protected $perPageButtonEnabled = true;

    protected $searchUrl;

    abstract protected function columns(): array;

    public function toJson($options = 0): string
    {
        return collect([
            'columns'   => $this->columns(),
            'tools'     => $this->tools(),
        ])->toJson($options);
    }

    final public function tools(): array
    {
        if ($this->searchEnabled && !$this->searchUrl) {
            throw new \Exception('searchUrl is not defined!');
        }

        return [
            'editEnabled'           => $this->editEnabled,
            'deleteEnabled'         => $this->deleteEnabled,
            'searchEnabled'         => $this->searchEnabled,
            'perPageButtonEnabled'  => $this->perPageButtonEnabled,
            'searchUrl'             => $this->searchUrl,
            'buttonsEnabled'        => $this->editEnabled && $this->deleteEnabled,
        ];
    }
}