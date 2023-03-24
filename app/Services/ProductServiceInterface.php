<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Product service interface
 */
interface ProductServiceInterface
{
    /**
     * Get product list
     *
     * @param array $filter
     *
     * @return LengthAwarePaginator
     */
    public function getList(array $filter): LengthAwarePaginator;

    /**
     * Update product by id
     *
     * @param int $id
     * @param array $input
     * @param UploadedFile|null $image
     *
     * @return void
     */
    public function updateById(int $id, array $input, ?UploadedFile $image): void;

    /**
     * Remove product image
     *
     * @param int $id
     *
     * @return void
     */
    public function removeImage(int $id): void;

    /**
     * Get product by id
     *
     * @param int $id
     *
     * @return Product
     */
    public function getById(int $id): Product;

    /**
     * Destroy product
     *
     * @param int $id
     *
     * @return void
     */
    public function destroy(int $id): void;

    /**
     * Store product
     *
     * @param array $input
     * @param UploadedFile|null $image
     *
     * @return void
     */
    public function store(array $input, ?UploadedFile $image): void;

    /**
     * Create product
     *
     * @return Product
     */
    public function create(): Product;
}
