<?php

namespace View\Components;

use App\Models\Product;
use App\View\Components\ProductCard;
use Illuminate\Contracts\View\View;
use Tests\TestCase;

/**
 * Class test for App\View\Components\ProductCard
 *
 * @property ProductCard $instance
 */
class ProductCardTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->setInstance();
    }

    private function setInstance(): void
    {
        $this->instance = new ProductCard(new Product());
    }

    public function testRender(): void
    {
        $result = $this->instance->render();
        $this->assertInstanceOf(View::class, $result);
        $this->assertEquals('components.product-card', $result->name());
    }
}
