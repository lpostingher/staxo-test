<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductServiceInterface
{
    public function getList(array $filter): LengthAwarePaginator;

    public function updateById(int $id, array $input, ?UploadedFile $image): void;

    public function removeImage(int $id): void;

    public function getById(int $id): Product;

    public function destroy(int $id): void;

    public function store(array $input, ?UploadedFile $image): void;

    public function create(): Product;
}
