<?php

namespace Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

/**
 * Test class for App\Http\Controllers\ProductController
 *
 * @property User $user
 */
class ProductControllerTest extends TestCase
{
    /**
     * @test
     */
    public function testUnauthenticated(): void
    {
        Auth::logout();

        $this->get(route('product.index'))
            ->assertRedirect(route('login'));

        $this->get(route('product.create'))
            ->assertRedirect(route('login'));

        $this->post(route('product.store'))
            ->assertRedirect(route('login'));

        $this->put(route('product.update', '1'))
            ->assertRedirect(route('login'));

        $this->delete(route('product.destroy', '1'))
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function testIndex(): void
    {
        $this->get(route('product.index'))
            ->assertSuccessful()
            ->assertViewHas('products')
            ->assertViewIs('product.index');
    }

    /**
     * @test
     */
    public function testCreate(): void
    {
        $this->get(route('product.create'))
            ->assertSuccessful()
            ->assertViewHas('product')
            ->assertViewHas('formRoute', route('product.store'))
            ->assertViewIs('product.form');
    }

    /**
     * @test
     */
    public function testStore(): void
    {
        $product = Product::factory()->make();
        $this->post(route('product.store'), $product->toArray())
            ->assertRedirect(route('product.index'))
            ->assertSessionHas('flash_message', ['status' => 'success', 'message' => 'Product created successfully']);
    }

    /**
     * @test
     */
    public function testShow(): void
    {
        $this->get(route('product.show', encrypt('1')))
            ->assertNotFound();

        $product = Product::factory()->create();
        $this->get(route('product.show', encrypt($product->id)))
            ->assertSuccessful()
            ->assertViewHas('product');
    }

    /**
     * @test
     */
    public function testEdit(): void
    {
        $product = Product::factory()->create();
        $id = encrypt($product->id);
        $this->get(route('product.edit', $id))
            ->assertSuccessful()
            ->assertViewHas('product')
            ->assertViewHas('formRoute', route('product.update', $id))
            ->assertViewIs('product.form');
    }

    /**
     * @test
     */
    public function testUpdate(): void
    {
        $product = Product::factory()->create();
        $id = encrypt($product->id);
        $this->put(route('product.update', $id), ['name' => 'New name', 'price' => $product->price])
            ->assertRedirect()
            ->assertSessionHas('flash_message', ['status' => 'success', 'message' => 'Product updated successfully']);
    }

    /**
     * @test
     */
    public function testDestroy(): void
    {
        $product = Product::factory()->create();
        $this->delete(route('product.destroy', encrypt($product->id)))
            ->assertRedirect()
            ->assertSessionHas('flash_message', ['status' => 'success', 'message' => 'Product removed successfully']);
    }

    /**
     * @test
     */
    public function testRemoveImage(): void
    {
        $product = Product::factory()->create();
        $this->get(route('product.removeImage', encrypt($product->id)))
            ->assertRedirect()
            ->assertSessionHas('flash_message', ['status' => 'success', 'message' => 'Image removed successfully']);
    }

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }
}
