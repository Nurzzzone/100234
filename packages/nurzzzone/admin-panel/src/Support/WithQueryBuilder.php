<?php

namespace Nurzzzone\AdminPanel\Support;

use Illuminate\Database\Eloquent\Builder;

trait WithQueryBuilder
{
    /**
     * @var Builder
     */
    protected $queryBuilder;

    public function getQueryBuilder(): Builder
    {
        return $this->queryBuilder;
    }

    public function setQueryBuilder(Builder $value): self
    {
        $this->queryBuilder = $value;

        return $this;
    }
}