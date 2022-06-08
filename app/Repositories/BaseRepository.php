<?php

namespace App\Repositories;

abstract class BaseRepository
{
    protected $searchParam = 'searchKeyword';

    protected $perPageParam = 'perPage';

    protected $searchQuery;

    protected $perPageQuantity;

    public function __construct()
    {
        $this->searchQuery = request($this->searchParam);
        $this->perPageQuantity = request($this->perPageParam, 10);
    }
}