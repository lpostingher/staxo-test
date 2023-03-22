<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getList(array $filter)
    {
        $query = Product::query();

        $query->when(isset($filter['name']), function ($query) use ($filter) {
            $term = str($filter['name'])->trim();
            $query->where('like', "%{$term}%");
        });

        return $query->paginate(50);
    }
}
