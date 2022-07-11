<?php

namespace Nurzzzone\AdminPanel\Support\Table\Column;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

/**
 * @className Column
 * @package Nurzzzone\AdminPanel\Support\Table\Column
 */
class Column implements Arrayable
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $columnName;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $joinColumnName;

    public function __construct(string $columnLabel, string $columnName, ?string $joinColumnName = null)
    {
        $this->label = $columnLabel;
        $this->columnName = $columnName;
        $this->joinColumnName = $joinColumnName;
    }

    public function toArray(): array
    {
        $column =  [];

        if (! is_null($this->joinColumnName)) {
            $column['joinColumnName'] = $this->joinColumnName;
        }

        if (property_exists($this, 'url')) {
            $column['url'] = $this->url;
        }

        if (property_exists($this, 'sync')) {
            $column['sync'] = $this->sync;
        }

        return array_merge([
            'label'         => $this->label,
            'columnName'    => $this->columnName,
            'type'          => $this->type,
        ], $column);
    }
}
