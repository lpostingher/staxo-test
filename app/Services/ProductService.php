<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

/**
 * @inheritDoc
 */
class ProductService implements ProductServiceInterface
{
    /**
     * @inheritDoc
     */
    public function getList(array $filter): LengthAwarePaginator
    {
        $query = Product::query();

        $query->when(isset($filter['term']), function ($query) use ($filter) {
            $name = str($filter['term'])->trim();
            $query->where('name', 'like', "%{$name}%");
        });

        $query->orderBy('created_at', 'desc');

        return $query->paginate(10);
    }

    /**
     * @inheritDoc
     */
    public function updateById(int $id, array $input, ?UploadedFile $image): void
    {
        if ($image) {
            $input['image_path'] = $this->handleImage($image);
        }
        $product = Product::where('id', $id)->firstOrFail();
        $product->update($input);
    }

    /**
     * @inheritDoc
     */
    public function removeImage(int $id): void
    {
        $product = $this->getById($id);
        if (! $product->image_path) {
            return;
        }
        Storage::disk('public')->delete($product->image_path);
        $product->update(['image_path' => null]);
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id): Product
    {
        return Product::where('id', $id)->firstOrFail();
    }

    /**
     * @inheritDoc
     */
    public function destroy(int $id): void
    {
        $product = $this->getById($id);
        $product->delete();
    }

    /**
     * @inheritDoc
     */
    public function store(array $input, ?UploadedFile $image): void
    {
        $product = Product::create($input);
        if ($image) {
            $product->update(['image_path' => $this->handleImage($image)]);
        }
    }

    /**
     * @inheritDoc
     */
    public function create(): Product
    {
        return Product::make(['price' => 0]);
    }

    /**
     * Handle image upload
     *
     * @param UploadedFile $file
     *
     * @return false|string
     */
    private function handleImage(UploadedFile $file): bool|string
    {
        return Storage::disk('public')->putFile('images/products', $file);
    }
}
