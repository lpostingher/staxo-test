<?php

namespace Tests\Unit\View\Components;

use App\Models\Product;
use App\View\Components\ProductRow;
use Illuminate\Contracts\View\View;
use Tests\TestCase;

/**
 * Class test for App\View\Components\ProductRow
 *
 * @property ProductRow $instance
 */
class ProductRowTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->setInstance();
    }

    private function setInstance(): void
    {
        $this->instance = new ProductRow(new Product());
    }

    public function testRender(): void
    {
        $result = $this->instance->render();
        $this->assertInstanceOf(View::class, $result);
        $this->assertEquals('components.product-row', $result->name());
    }
}
