<?php

namespace App\Http\Controllers;

use App\Imports\CrossesImport;
use App\Imports\DeleteCrossImport;
use App\Traits\HasFlashMessage;
use Illuminate\Http\Request;

class CrossImportController extends Controller
{
    use HasFlashMessage;

    public function store(Request $request)
    {
        $columnsInFile = [  //TODO убрать
            "manufacturer_column" => "manufacturer",
            "article_column" => "article",
            "substitute_manufacturer_column" => "substitute_manufacturer",
            "substitute_article_column" => "substitute_article",
            "name_column" => "name",
            "quality_column" => "quality",
        ];

        (new CrossesImport($columnsInFile))
            ->queue($request->file('crosses'));

        return $this->flashSuccessMessage($request);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'crosses' => 'required'
        ]);

        (new DeleteCrossImport())
            ->queue($request->file('crosses'));

        return $this->flashSuccessMessage($request);
    }


}
