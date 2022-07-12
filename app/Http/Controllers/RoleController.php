<?php

namespace App\Http\Controllers;

use App\Models\Auth\Role;
use Nurzzzone\AdminPanel\Controllers\AdminController;
use Nurzzzone\AdminPanel\Support\Contracts\FromForm;
use Nurzzzone\AdminPanel\Support\Contracts\FromTable;
use Nurzzzone\AdminPanel\Support\Form;
use Nurzzzone\AdminPanel\Support\Table;

class RoleController extends AdminController implements FromForm, FromTable
{
    protected $pageTitle = 'Roles';

    public function fromTable(): Table
    {
        $table = new Table();
        $table->setBuilder(Role::query());
        $table->enableSearch();
        $table->enablePagination();
        $table->enableCreate('/role/create');
        $table->addColumn(new Table\Column\Text('Наименование', 'name'));
        return $table;
    }

    public function fromForm(): Form
    {
        return (new Form())
            ->from(new Role())
            ->addField(new Form\Text('Наименование', 'name'))
            ->addField(new Form\Radio('Отображение', 'is_active'));
    }
}
