<?php

namespace Nurzzzone\AdminPanel\Support;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder;

/**
 * @className WithQueryBuilder
 * @package Nurzzzone\AdminPanel\Support
 */
trait WithBuilder
{
    /**
     * @var mixed
     */
    protected $builder;

    /**
     * @param mixed $value
     * @return $this
     */
    public function setBuilder($value): self
    {
        if (!$value instanceof Builder && !$value instanceof EloquentBuilder) {
            $errorMessage = sprintf('Builder must be instance of %s or %s', Builder::class, EloquentBuilder::class);

            throw new \InvalidArgumentException($errorMessage);
        }

        $this->builder = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBuilder()
    {
        return $this->builder;
    }
}
