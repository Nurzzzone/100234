<?php

namespace App\Http\Controllers;

use App\Models\Auth\Role;
use Nurzzzone\AdminPanel\Controllers\AdminController;
use Nurzzzone\AdminPanel\Support\Contracts\FromForm;
use Nurzzzone\AdminPanel\Support\Form;

class RoleController extends AdminController implements FromForm
{
    protected $pageTitle = 'Roles';

    public function fromForm(): Form
    {
        return (new Form())
            ->from(new Role())
            ->addField(new Form\Text('Наименование', 'name'))
            ->addField(new Form\Radio('Отображение', 'is_active'));
    }
}
