<?php

namespace App\Models\StaticPages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    use HasFactory;

    protected $connection = 'adkulan_dev';

    protected $table = 'help';

    protected $primaryKey = 'GUID';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'order'
    ];

    public $timestamps = false;

    public function dropdown(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DropDown::class, 'parent_id', 'GUID');
    }
}
