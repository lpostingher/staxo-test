<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class ProductService
{
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

    public function updateById(int $id, array $input, ?UploadedFile $image)
    {
        if ($image) {
            $input['image_path'] = $this->handleImage(encrypt($id), $image);
        }
        $product = Product::where('id', $id)->firstOrFail();
        $product->update($input);
    }

    private function handleImage(string $productId, UploadedFile $file)
    {
        $path = Storage::disk('public')->putFile('images/products', $file);
        return $path;
    }

    public function removeImage(int $id)
    {
        $product = $this->getById($id);
        if (!$product->image_path) {
            return;
        }
        Storage::disk('public')->delete($product->image_path);
        $product->update(['image_path' => null]);
    }

    public function getById(int $id): Product
    {
        return Product::where('id', $id)->firstOrFail();
    }

    public function destroy(int $id)
    {
        $product = $this->getById($id);
        $product->delete();
    }

    public function store(array $input, ?UploadedFile $image)
    {
        $product = Product::create($input);
        if ($image) {
            $product->update([
                'image_path' => $this->handleImage(encrypt($product->id), $image)
            ]);
        }
    }

    public function create(): Product
    {
        return Product::make(['price' => 0]);
    }
}
