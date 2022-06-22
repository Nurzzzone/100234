<?php

namespace App\Models\Outside;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PopularCategory extends Outside
{
    use HasFactory;

    protected $table = 'popular_categories';

    protected $primaryKey = 'GUID';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'GUID',
        'hierarchy_id',
        'hierarchy_type',
        'description',
        'is_active',
        'image',
        'sequence',
    ];

    public function hierarchy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hierarchy::class, 'hierarchy_id', 'GUID');
    }

    protected function getEditUrlAttribute(): ?string
    {
        return route('popularCategory.edit', $this->getKey());
    }
}
