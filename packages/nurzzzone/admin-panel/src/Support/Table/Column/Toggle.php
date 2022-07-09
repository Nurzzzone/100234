<?php

namespace Nurzzzone\AdminPanel\Support\Table\Column;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @className Toggle
 * @package Nurzzzone\AdminPanel\Support\Table\Column
 */
class Toggle extends Column
{
    /**
     * @var string
     */
    protected $type = 'toggle';

    /**
     * @var bool
     */
    protected $sync = false;

    public function enableSync(): self
    {
        $this->sync = true;

        return $this;
    }

    /**
     * @throws \ReflectionException
     */
    public function __construct(string $columnLabel, string $columnName, ?string $joinColumnName = null)
    {
        $trace = Arr::first(debug_backtrace());

        $reflectionClass = new \ReflectionClass('app' . Str::between($trace['file'], 'app', '.php'));

        if (! $reflectionClass->hasMethod('handleToggle')) {
            throw new \RuntimeException(sprintf('%s must implement method handleToggle', $reflectionClass->getName()));
        }

        parent::__construct($columnLabel, $columnName, $joinColumnName);
    }
}
