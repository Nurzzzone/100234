#### Installation

```sh
composer require nurzzzone/admin-panel
```

```sh
php artisan vendor:publish admin-panel-assets
```

#### Usage
```php
class PostController extends \Nurzzzone\AdminPanel\Controllers\TableController
{
    public function fromTable() 
    {
        $table = new \Nurzzzone\AdminPanel\Support\Table(Post::query());
        $table->enablePagination();
        $table->addColumn(new \Nurzzzone\AdminPanel\Support\Table\Text('ID', 'id'));
        $table->addColumn(new \Nurzzzone\AdminPanel\Support\Table\Text('Title', 'title'))
        return $table;
    }
}
```