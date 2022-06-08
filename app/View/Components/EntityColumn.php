<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class EntityColumn extends Component
{
    public $column;
    public $class;
    public $plainText;
    protected $object;

    public function __construct(Model $object, string $column, bool $plainText = false)
    {

        $this->object = $object;
        $this->plainText = $plainText;
        $this->column = $this->resolveColumn($column);
        $this->class = $this->class();
    }

    public function render()
    {
        return view('components.entity-column');
    }

    protected function class(): string
    {
        return empty($this->column)? 'text-muted': '';
    }

    protected function resolveColumn(string $column)
    {
        if (! Str::contains($column, '.')) {
            return $this->object->$column;
        }

        if (Str::substrCount($column, '.') > 1) {
            return $this->nestedRelationColumn($column);
        }

        return $this->relationColumn($column);
    }

    protected function relationColumn(string $column)
    {
        [$relation, $column] = explode('.', $column);

        return optional($this->object->$relation)->$column;
    }

    protected function nestedRelationColumn(string $column)
    {
        return $column;
    }
}
