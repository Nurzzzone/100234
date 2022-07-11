<?php

namespace Nurzzzone\AdminPanel\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait HasColumns
{
    /**
     * @var array
     */
    private $columns = [];

    /**
     * Adds text type column
     *
     * @param string $label
     * @param string $columnName
     * @param string|null $joinColumnName
     * @return $this
     */
    public function addColumnText(string $label, string $columnName, ?string $joinColumnName = null): self
    {
        $column = compact('label', 'columnName');

        if (! is_null($joinColumnName)) {
            $column['joinColumnName'] = $joinColumnName;
        }

        $this->columns[] = $column['type'] = 'text';

        return $this;
    }

    /**
     * Adds toggle type column
     *
     * @param string $label
     * @param string $columnName
     * @param bool|null $sync
     * @return $this
     * @throws \ReflectionException
     */
    public function addColumnToggle(string $label, string $columnName, ?bool $sync = false): self
    {
        $trace = Arr::first(debug_backtrace());

        $reflectionClass = new \ReflectionClass('app' . Str::between($trace['file'], 'app', '.php'));

        if (! $reflectionClass->hasMethod('handleToggle')) {
            throw new \RuntimeException(sprintf('%s must implement method handleToggle', $reflectionClass->getName()));
        }

        $this->columns[] = compact('label', 'columnName', 'sync')['type'] = 'toggle';

        return $this;
    }

    /**
     * Adds check type column
     *
     * @param string $label
     * @param string $columnName
     * @return $this
     */
    public function addColumnCheck(string $label, string $columnName): self
    {
        $this->columns[] = compact('label', 'columnName')['type'] = 'check';

        return $this;
    }

    /**
     * Add link type column
     *
     * @param string $label
     * @param string $columnName
     * @param string $url
     * @return $this
     */
    public function addColumnLink(string $label, string $columnName, string $url): self
    {
        $this->columns[] = compact('label', 'columnName', 'url')['type'] = 'link';

        return $this;
    }

    /**
     * Adds image type column
     *
     * @param string $label
     * @param string $columnName
     * @return $this
     */
    public function addColumnImage(string $label, string $columnName): self
    {
        $this->columns[] = compact('label', 'columnName')['type'] = 'image';

        return $this;
    }
}
