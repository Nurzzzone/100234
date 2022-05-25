<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $connection = 'adkulan_dev';

    protected $table = 'news';

    protected $fillable = [
        'title',
        'description',
        'content',
        'image',
        'is_active',
        'is_new',
        'in_main_page',
        'starts_at',
    ];

    protected const image = '/assets/images/default-image.jpg';

    public function getStartsAtAttribute($value)
    {
        return Carbon::parse($value);
    }
}
