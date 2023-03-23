<?php

namespace Models;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Test class for App\Models\Product
 */
class ProductTest extends TestCase
{
    /**
     * @test
     */
    public function testGetImageUrlAttribute(): void
    {
        $product = Product::factory()->create();
        $this->assertEquals(Product::NO_IMAGE_PATH, $product->image_url);

        $service = new ProductService();
        $file = UploadedFile::fake()->create('image.jpg');
        $service->updateById($product->id, [], $file);
        $product = $service->getById($product->id);

        $this->assertEquals(Storage::disk('public')->url($product->image_path), $product->image_url);
    }

    /**
     * @test
     */
    public function testGetPriceFormattedAttribute(): void
    {
        $product = Product::factory()->create();
        $expected = "$" . number_format($product->price, 2);
        $this->assertEquals($expected, $product->price_formatted);
    }

    /**
     * @test
     */
    public function testDeleteObserver(): void
    {
        $product = Product::factory()->create();
        $service = new ProductService();
        $file = UploadedFile::fake()->create('image.jpg');
        $service->updateById($product->id, [], $file);
        $product = $service->getById($product->id);

        $this->assertTrue(Storage::disk('public')->exists($product->image_path));

        $product->delete();
        $this->assertFalse(Storage::disk('public')->exists($product->image_path));
    }

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }
}
