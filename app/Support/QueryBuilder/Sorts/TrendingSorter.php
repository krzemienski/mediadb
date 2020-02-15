<?php

namespace App\Support\QueryBuilder\Sorts;

use CyrildeWit\EloquentViewable\Support\Period;
use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Sorts\Sort;

class TrendingSorter implements Sort
{
    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param bool                                  $descending
     * @param string                                $property
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function __invoke(Builder $query, bool $descending, string $property): Builder
    {
        return $query->withCount(['views' => function ($query) {
            $query->withinPeriod(Period::pastDays(3))->uniqueVisitor();
        }])->orderBy('views_count', 'DESC');
    }
}
