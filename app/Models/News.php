<?php

namespace App\Models;

use App\Models\Outside\Outside;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Outside
{
    use HasFactory;

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

    protected $appends = [
        'editUrl',
        'updateToggleUrl'
    ];

    protected const image = '/assets/images/default-image.jpg';

    public function getStartsAtAttribute($value): Carbon
    {
        return Carbon::parse($value);
    }

    protected function getEditUrlAttribute(): ?string
    {
        return route('news.edit', $this->getKey());
    }

    protected function getUpdateToggleUrlAttribute(): string
    {
        return route('news.updateToggle', $this->getKey());
    }
}
