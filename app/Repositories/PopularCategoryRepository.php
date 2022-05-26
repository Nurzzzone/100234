<?php

namespace App\Repositories;

use App\Models\Outside\Hierarchy;
use App\Models\Outside\PopularCategory;
use Ramsey\Uuid\Uuid;

class PopularCategoryRepository
{
    public function getObjects()
    {
        return PopularCategory::query()
            ->where('hierarchy_type', 'adkulan_hierarchy')
            ->joinSub(Hierarchy::query(), 'hierarchies', function($join) {
                $join->on('popular_categories.hierarchy_id', 'hierarchies.GUID');
            })
            ->orderBy('sequence')
            ->select(['popular_categories.GUID', 'hierarchies.name', 'popular_categories.is_active'])
            ->paginate(10);
    }

    public function getAvailableOptions(?string $hierarchy_id = null): \Illuminate\Support\Collection
    {
        return Hierarchy::query()
            ->orderBy('name')
            ->where('parent', Uuid::NIL)
            ->whereNotIn('GUID', function($query) use($hierarchy_id) {
                $query->select('hierarchy_id')
                    ->from('popular_categories')
                    ->where('hierarchy_type', 'adkulan_hierarchy')
                    ->when($hierarchy_id, function($query) use ($hierarchy_id) {
                        $query->where('hierarchy_id', '!=', $hierarchy_id);
                    });
            })
            ->pluck('name', 'GUID');
    }

    public function getLatestSequence()
    {
        $latest = PopularCategory::query()
            ->latest('sequence')
            ->first()
            ->sequence;

        return ++$latest;
    }
}