### Installation

```sh
composer require nurzzzone/admin-panel
```
After package installation run this command to add assets(javascript/css) into public directory 
```sh
php artisan vendor:publish admin-panel-assets
```

### Basic Usage
`\Nurzzzone\AdminPanel\Support\Table` component renders rows from database as table

```php
class PostController extends \Nurzzzone\AdminPanel\Controllers\TableController
{
    public function fromTable() 
    {
        $table = new \Nurzzzone\AdminPanel\Support\Table(Post::query());
        $table->enablePagination();
        $table->addColumn(new \Nurzzzone\AdminPanel\Support\Table\Text('ID', 'id'));
        $table->addColumn(new \Nurzzzone\AdminPanel\Support\Table\Text('Title', 'title'));
        return $table;
    }
}
```
If you want to add your custom views using admin-panel layout you need to add this into the top of the blade file:
```php
@extends('admin-panel::layouts.base')

@section('title', 'Blog Posts') // page title

@section('css')
    // styles
@endsection()

@section('content')
    // html content
@endsection()

@section('scripts')
    // js
@endsection()
```