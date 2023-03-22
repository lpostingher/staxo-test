<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getList(array $filter)
    {
        $query = Product::query();

        $query->when(isset($filter['term']), function ($query) use ($filter) {
            $name = str($filter['term'])->trim();
            $query->where('name', 'like', "%{$name}%");
        });

        return $query->paginate(50);
    }
}
