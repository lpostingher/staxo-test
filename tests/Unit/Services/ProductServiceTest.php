<?php

namespace Tests\Unit\Services;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Test class for ProductService
 *
 * @property ProductService $instance
 */
class ProductServiceTest extends TestCase
{
    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->instance = new ProductService();
        Storage::fake('public');
    }

    /**
     * @test
     */
    public function testGetList(): void
    {
        $this->createProducts();

        $result = $this->instance->getList([]);

        $this->assertCount(3, $result);
    }

    /**
     * @test
     */
    public function testGetListFilter(): void
    {
        $this->createProducts();

        $filter = [
            'term' => 'Product A',
        ];

        $result = $this->instance->getList($filter);

        $this->assertCount(1, $result);
    }

    /**
     * @test
     */
    public function testGetById(): void
    {
        $product = Product::factory()->create();
        $this->assertEquals($product->id, $this->instance->getById($product->id)->id);
    }

    /**
     * @test
     */
    public function testUpdateById(): void
    {
        $product = Product::factory()->create();
        $this->instance->updateById(
            $product->id,
            ['name' => 'New Name'],
            null
        );
        $this->assertDatabaseHas('products', ['id' => $product->id, 'name' => 'New Name']);
    }

    /**
     * @test
     */
    public function testUpdateByIdWithImage(): void
    {
        $product = Product::factory()->create();
        $file = UploadedFile::fake()->create('image.jpg');
        $this->instance->updateById($product->id, [], $file);
        $product = $this->instance->getById($product->id);
        $this->assertTrue(Storage::disk('public')->exists($product->image_path));
    }

    /**
     * @test
     */
    public function testRemoveImage(): void
    {
        $file = UploadedFile::fake()->create('image.jpg');
        $this->instance->store(['name' => 'Product', 'price' => 123], $file);
        $product = Product::firstOrFail();
        $this->assertTrue(Storage::disk('public')->exists($product->image_path));

        $this->instance->removeImage($product->id);
        $this->assertFalse(Storage::disk('public')->exists($product->image_path));
        $this->assertDatabaseHas('products', ['id' => $product->id, 'image_path' => null]);
    }

    /**
     * @test
     */
    public function testDestroy(): void
    {
        $product = Product::factory()->create();
        $this->instance->destroy($product->id);
        $this->assertDatabaseMissing('products', ['id' => $product->id, 'deleted_at' => null]);
    }

    /**
     * @test
     */
    public function testCreate(): void
    {
        $product = $this->instance->create();
        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals(0, $product->price);
    }

    private function createProducts(): void
    {
        Product::factory()->create(['name' => 'Product A']);
        Product::factory()->create(['name' => 'Product B']);
        Product::factory()->create(['name' => 'Product C']);
    }
}
