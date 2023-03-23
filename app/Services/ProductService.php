<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

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

    public function getById(int $id): Product
    {
        return Product::where('id', $id)->firstOrFail();
    }

    public function updateById(int $id, array $input, ?UploadedFile $image)
    {
        if ($image) {
            $input['image_path'] = $this->handleImage(encrypt($id), $image);
        }
        $product = Product::where('id', $id)->firstOrFail();
        $product->update($input);
    }

    public function handleImage(string $productId, UploadedFile $file)
    {
        $path = Storage::disk('public')->putFile('images/products', $file);
        return $path;
    }

    public function removeImage(int $id)
    {
        $product = $this->getById($id);
        Storage::disk('public')->delete($product->image_path);
        $product->update(['image_path' => null]);
    }

    public function destroy(int $id)
    {
        $product = $this->getById($id);
        $product->delete();
    }
}
