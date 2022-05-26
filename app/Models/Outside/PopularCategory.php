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
        'hierarchy_id',
        'hierarchy_type',
        'description',
        'is_active',
        'image',
        'sequence',
    ];

    public function hierarchy()
    {
        return $this->belongsTo(Hierarchy::class, 'hierarchy_id', 'GUID');
    }
}
