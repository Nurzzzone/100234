<?php

namespace App\Models\StaticPages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Security extends Model
{
    use HasFactory;

    protected $connection = 'adkulan_dev';

    protected $table = 'security';

    protected $primaryKey = 'GUID';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'content',
        'is_active',
        'in_footer',
        'order'
    ];
}
