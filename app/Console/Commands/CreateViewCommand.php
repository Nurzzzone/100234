<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\File;

class CreateViewCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {entity?}';

    /**
     * The console command description.
     *
     * @var string
     */
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

    public function handle()
    {
        $this->entity = $this->getModelName();
        $this->askForBladeFiles();
        $bladeFiles = $this->getBladeFiles();

        $this->page_title = $this->ask('Введите наименование страницы', 'Page Title');
        $this->table_columns = $this->getTableColumns();
        $this->perPageItems = $this->ask('Кол-во элементов в таблице (пагинация): ', '10');
        $this->controllerClassName = $this->ask('Введите название контроллера', ($this->entity ?? $this->argument('entity')) . 'Controller');

        $stubs = $this->getStub();

        $requests = $this->createRequests($this->entity);

        $this->createController($this->entity, $requests);

        $viewDirPath = $this->createViewDir($this->entity);

        # ========================================== #
        foreach($bladeFiles as $bladeFile) {
            if ($bladeFile['enabled']) {
                if (! File::exists($filepath = $viewDirPath . $bladeFile['file_name']) )
                {
                    $content = File::get($stubs[$bladeFile['name']]);
                    File::put($filepath, $content);
                }
                $this->info("{$bladeFile['file_name']} for $this->entity created!");
            }
        }

        # ========================================== #
        $this->info("Crud for {$this->entity} created.");
        $uri = mb_strtolower($this->entity);
        $this->warn("Add this into you're web.php file: Route::resource('$uri', '$this->controllerClassName')");
    }

    protected function getBladeFiles(): array
    {
        return [
            [
                'file_name' => 'index.blade.php',
                'name' => 'index',
                'enabled' => $this->shouldCreateIndexBlade,
            ],
            [
                'file_name' => 'create.blade.php',
                'name' => 'create',
                'enabled' => $this->shouldCreateCreateBlade,
            ],
            [
                'file_name' => 'edit.blade.php',
                'name' => 'edit',
                'enabled' => $this->shouldCreateEditBlade,
            ],
            [
                'file_name' => 'show.blade.php',
                'name' => 'show',
                'enabled' => $this->shouldCreateShowBlade,
            ],
            [
                'file_name' => '__table.blade.php',
                'name' => '__table',
                'enabled' => $this->shouldCreateIndexBlade,
            ],
            [
                'file_name' => '__form.blade.php',
                'name' => '__form',
                'enabled' => $this->shouldCreateCreateBlade && $this->shouldCreateEditBlade,
            ]
        ];
    }

    protected function createViewDir($model)
    {
        $dir = mb_strtolower($model);

        $path = "resources\\views\\pages\\$dir\\";

        if (File::isDirectory($path)) {
            $this->error("Resource or directory already exists!");
        }

        # ========================================== #
        mkdir($path, 0777, true);

        return $path;
    }

    protected function createController($model, $requests)
    {
        $route = $model;
        $object = $model;
        if (str_contains($model, '\\')) {
            $mapped = array_map(function($item) {
                return ucfirst($item);
            }, explode('\\', $model));
            $route = str_replace('\\', '.', $model);
            $for_object = explode('.', $route);
            $object = end($for_object);
            $model = implode('', $mapped);
        }

        $filename = ucfirst($model);
        $path = "App\\Http\\Controllers";

        $components = $this->getControllerComponents($filename, $path, $route, $object, $filename, $requests);

        $replacements = $this->getReplacementReferences();

        $replace_to = array_filter($components, function($key) {
            return $key !== 'filename' && $key !== 'content';
        }, ARRAY_FILTER_USE_KEY);

        $this->replaceReference($components['content'], $replacements, $replace_to, "$path\\{$components['filename']}");

        $this->info("{$components['class']} created!");
    }

    protected function createRequests($model)
    {
        if (str_contains($model, '\\')) {
            $exploded = explode('\\', $model);
            $except_last = array_slice($exploded, 0, -1);
            $ucfirsted = array_map(function($item) {
                return ucfirst($item);
            }, $except_last);
            $dir_name = implode('\\', $ucfirsted);
            $model = end($exploded);
        }
        $dir_name = ucfirst($model);
        $name = ucfirst($model);

        $requests = $this->getRequestsComponents($name, $dir_name);
        $replacements = ['{{class}}', '{{namespace}}'];
        $dir_path = $this->makeDirOptional("app\\Http\\Requests\\{$dir_name}");

        foreach($requests as $request) {
            if ($request['enabled']) {
                if (!File::exists($request['namespace'] . $request['filename'])) {
                    $this->replaceReference($request['content'], $replacements, [$request['class'], $request['namespace']], "$dir_path\\{$request['filename']}");
                }
                $this->info("{$request['filename']} created!");
            }
        }
        return $requests;
    }

    protected function getStub(): array
    {
        $dir = app_path('\\Console\\Stubs\\Resource\\');
        $scanned = scandir($dir);
        $stubs = array_diff($scanned, ['..', '.']);

        # ========================================== #
        return array_reduce($stubs, function($carry, $stub) use ($dir) {
            $carry[explode('.', $stub)[0]] = $dir . $stub;
            return $carry;
        }, []);
    }

    private function replaceReference($content_path, $find, $replace_to, $put_path)
    {
        $file_contents = file_get_contents($content_path);
        $file_contents = str_replace($find, $replace_to, $file_contents);
        file_put_contents($put_path, $file_contents);
    }

    private function getRequestsComponents($name, $dir_name)
    {
        return [
            [
                'filename' => "Create{$name}Request.php",
                'class' => "Create{$name}Request",
                'namespace' => "App\Http\Requests\\$dir_name",
                'content' =>  "app\\Console\\Stubs\\create-request.stub",
                'enabled' => $this->shouldCreateCreateBlade,
            ],
            [
                'filename' => "Update{$name}Request.php",
                'class' => "Update{$name}Request",
                'namespace' => "App\Http\Requests\\$dir_name",
                'content' => "app\\Console\\Stubs\\update-request.stub",
                'enabled' => $this->shouldCreateEditBlade,
            ]
        ];
    }

    private function getControllerComponents($name, $dir_path, $route, $object, $model, $requests)
    {
        return [
            'filename' => "$this->controllerClassName.php",
            'class' => $this->controllerClassName,
            'namespace' => "$dir_path",
            'content' =>  "app\\Console\\Stubs\\Controller\\controller.stub",
            'route' => mb_strtolower($route),
            'object' => mb_strtolower($object),
            'model' => $model,
            'page_title' => $this->page_title,
            'per_page_items' => (int) $this->perPageItems,
            'table_columns' => $this->table_columns,
            'createRequest' => $requests[0]['class'],
            'updateRequest' => $requests[1]['class'],
        ];
    }

    private function getReplacementReferences()
    {
        return [
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
    }

    private function makeDirOptional(string $dir_path)
    {
        if (!File::exists($dir_path)) {
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

        $columns = array_map(function($column) {
            return "'$column'";
        }, explode(',', $columns));

        return implode(',', $columns);
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
}