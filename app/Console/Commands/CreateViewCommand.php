<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\File;

class CreateViewCommand extends GeneratorCommand
{
    protected $signature = 'make:crud {entity?}';
    protected $description = 'Create new crud.';
    protected $entity;
    protected $page_title;
    protected $table_columns;
    protected $controllerClassName = true;
    protected $shouldCreateIndexBlade = true;
    protected $shouldCreateCreateBlade = true;
    protected $shouldCreateEditBlade = true;
    protected $shouldCreateShowBlade = true;
    protected $shouldCreateAllBlade = true;
    protected $perPageItems = 10;
    protected $controllersDir = "App\\Http\\Controllers";
    protected $controllerStub = "app\\Console\\Stubs\\Controller\\controller.stub";
    protected $createFormRequestStub = "app\\Console\\Stubs\\create-request.stub";
    protected $updateFormRequestStub = "app\\Console\\Stubs\\update-request.stub";
    protected $createFormRequestClassName;
    protected $updateFormRequestClassName;
    protected $viewDir;
    protected $route;
    protected $object;
    protected $replacementsReferences = [
        '{{class}}',
        '{{namespace}}',
        '{{route}}',
        '{{object}}',
        '{{model}}',
        '{{pageTitle}}',
        '{{perPageItems}}',
        '{{tableColumns}}',
        '{{createRequest}}',
        '{{updateRequest}}',
    ];

    public function handle()
    {
        $this->entity = $this->getModelName();

        // ===============================================
        $this->askForBladeFiles();

        // ===============================================
        $this->page_title = $this->ask('Введите наименование страницы', 'Page Title');

        // ===============================================
        $this->table_columns = $this->getTableColumns();

        // ===============================================
        $this->perPageItems = $this->ask('Кол-во элементов в таблице (пагинация): ', '10');

        // ===============================================
        $this->controllerClassName = $this->ask('Введите название контроллера', ($this->entity ?? $this->argument('entity')) . 'Controller');

        // ===============================================
        $this->setRouteAndObjectName();

        // ===============================================
        $this->createFormRequests($this->entity);

        $this->createController();

        // ===============================================
        $this->createViewDir();

        $this->createBladeFiles();

        # ========================================== #
        $this->info("Crud for $this->entity created.");

        $this->warn("Add this into you're web.php file: Route::resource('$this->route', '$this->controllerClassName')");
    }

    protected function createBladeFiles()
    {
        $stubs = $this->getBladeFilesStubs();

        foreach($this->getBladeFilesComponents() as $component) {
            if (! $component['enabled']) {
                continue;
            }

            if (! File::exists($component['file_name'])) {
                $content = File::get($stubs[$component['name']]);
                File::put($component['file_name'], $content);
            }

            $this->info("{$component['file_name']} for $this->entity created!");
        }
    }

    protected function createViewDir()
    {
        $this->viewDir = "resources\\views\\pages\\$this->route\\";

        if (File::isDirectory($this->viewDir)) {
            $this->error("Resource or directory already exists!");
        }

        # ========================================== #
        mkdir($this->viewDir, 0777, true);
    }

    protected function setRouteAndObjectName()
    {
        $route = $this->entity;
        $object = $this->entity;

        if (str_contains($this->entity, '\\')) {
            $route = str_replace(['\\\\', '\\', '//', '/'], '.', $this->entity);

            $route_parts = array_map(function($item) {
                return ucfirst($item);
            }, explode('.', $route));

            $object = end($route_parts);
        }

        $this->route = lcfirst($route);
        $this->object = lcfirst($object);
    }

    protected function createController()
    {
        $component = $this->getControllerComponents(ucfirst($this->entity));

        $replace_to = array_filter($component, function($key) {
            return $key !== 'filename';
        }, ARRAY_FILTER_USE_KEY);

        $this->createFileFrom($this->controllerStub, $this->replacementsReferences, $replace_to,
            "$this->controllersDir\\{$component['filename']}"
        );

        $this->info("{$component['class']} created!");
    }

    protected function createFormRequests($model)
    {
        $dir_name = ucfirst($model);

        if (str_contains($model, '\\')) {
            $exploded = explode('\\', $model);
            $except_last = array_slice($exploded, 0, -1);
            $ucfirsted = array_map(function($item) {
                return ucfirst($item);
            }, $except_last);
            $dir_name = implode('\\', $ucfirsted);
            $model = end($exploded);
        }

        $name = ucfirst($model);

        $requests = $this->getRequestsComponents($name, $dir_name);
        $replacements = ['{{class}}', '{{namespace}}'];
        $dir_path = $this->makeDirOptional("app\\Http\\Requests\\$dir_name");

        foreach($requests as $request) {
            if ($request['enabled']) {
                $this->{$request['key']} = $request['class'];

                if (! File::exists($request['namespace'] . $request['filename'])) {
                    $this->createFileFrom($request['content'], $replacements, [$request['class'], $request['namespace']], "$dir_path\\{$request['filename']}");
                }
                $this->info("{$request['filename']} created!");
            }
        }
    }

    protected function getBladeFilesStubs(): array
    {
        $dir = app_path('\\Console\\Stubs\\Resource\\');
        $dir_content = scandir($dir);
        $stubs = array_diff($dir_content, ['..', '.']);

        # ========================================== #
        return array_reduce($stubs, function($carry, $stub) use ($dir) {
            $carry[explode('.', $stub)[0]] = $dir . $stub;
            return $carry;
        });
    }

    private function createFileFrom($content_path, $search, $replace_to, $put_path)
    {
        $file_contents = file_get_contents($content_path);
        $file_contents = str_replace($search, $replace_to, $file_contents);
        file_put_contents($put_path, $file_contents);
    }

    private function getRequestsComponents($name, $dir_name)
    {
        return [
            [
                'filename'      => "Create{$name}Request.php",
                'class'         => "Create{$name}Request",
                'namespace'     => "App\Http\Requests\\$dir_name",
                'content'       =>  $this->createFormRequestStub,
                'enabled'       => $this->shouldCreateCreateBlade,
                'key'           => 'createFormRequestClassName'
            ],
            [
                'filename'      => "Update{$name}Request.php",
                'class'         => "Update{$name}Request",
                'namespace'     => "App\Http\Requests\\$dir_name",
                'content'       => $this->createFormRequestStub,
                'enabled'       => $this->shouldCreateEditBlade,
                'key'           => 'updateFormRequestClassName'
            ]
        ];
    }

    private function getControllerComponents($model)
    {
        return [
            'filename'          => $this->controllerClassName . '.php',
            'class'             => $this->controllerClassName,
            'namespace'         => $this->controllersDir,
            'route'             => $this->route,
            'object'            => $this->object,
            'model'             => $model,
            'page_title'        => $this->page_title,
            'per_page_items'    => $this->perPageItems,
            'table_columns'     => $this->table_columns,
            'createRequest'     => $this->createFormRequestClassName,
            'updateRequest'     => $this->updateFormRequestClassName,
        ];
    }

    private function makeDirOptional(string $dir_path)
    {
        if (! File::exists($dir_path)) {
            File::makeDirectory($dir_path);
        }
        return $dir_path;
    }

    private function getModelName()
    {
        $entity = $this->ask('Введите название сущности', $this->argument('entity'));

        if (is_null($entity)) {
            throw new \Exception('Название сущности не может быть пустым!');
        }

        return $entity;
    }

    private function getTableColumns()
    {
        $columns = $this->ask('Введите название столбцов для отображение в таблице', '');

        if (empty($columns)) {
            return '';
        }

        return implode(',', array_map(function($column) {
            return "'$column'";
        }, explode(',', $columns)));
    }

    private function askForBladeFiles()
    {
        $this->shouldCreateAllBlade = $this->ask('Создать все blade файлы (index, create, edit, show)? ', 'y') == 'y';

        if (! $this->shouldCreateAllBlade) {
            $this->shouldCreateIndexBlade = $this->ask('Создать index.blade.php?', 'y') == 'y';
            $this->shouldCreateCreateBlade = $this->ask('Создать create.blade.php?', 'y') == 'y';
            $this->shouldCreateEditBlade = $this->ask('Создать edit.blade.php?', 'y') == 'y';
            $this->shouldCreateShowBlade = $this->ask('Создать show.blade.php?', 'y') == 'y';
        }
    }

    protected function getBladeFilesComponents(): array
    {
        return [
            [
                'file_name' => $this->viewDir . 'index.blade.php',
                'name' => 'index',
                'enabled' => $this->shouldCreateIndexBlade,
            ],
            [
                'file_name' => $this->viewDir . 'create.blade.php',
                'name' => 'create',
                'enabled' => $this->shouldCreateCreateBlade,
            ],
            [
                'file_name' => $this->viewDir . 'edit.blade.php',
                'name' => 'edit',
                'enabled' => $this->shouldCreateEditBlade,
            ],
            [
                'file_name' => $this->viewDir . 'show.blade.php',
                'name' => 'show',
                'enabled' => $this->shouldCreateShowBlade,
            ],
            [
                'file_name' => $this->viewDir . '__table.blade.php',
                'name' => '__table',
                'enabled' => $this->shouldCreateIndexBlade,
            ],
            [
                'file_name' => $this->viewDir . '__form.blade.php',
                'name' => '__form',
                'enabled' => $this->shouldCreateCreateBlade && $this->shouldCreateEditBlade,
            ]
        ];
    }

    protected function getStub()
    {
        // TODO: Implement getStub() method.
    }
}