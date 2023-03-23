<?php

namespace Http\Requests;

use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

/**
 * Test class for App\Http\Requests\StoreProductRequest
 *
 * @property StoreProductRequest $instance
 */
class StoreProductRequestTest extends TestCase
{
    /**
     * @test
     */
    public function testValidate(): void
    {
        $input = [
            'price' => 'price',
            'image' => 123321
        ];
        $validator = Validator::make($input, $this->instance->rules());
        $this->assertFalse($validator->passes());
        $this->assertEquals([
            'name' => ['The name field is required.'],
            'price' => ['The price field must be a number.'],
            'image' => [
                'The image field must be a file.',
                'The image field must be a file of type: jpg, png, jpeg, gif, svg.',
            ],
        ], $validator->errors()->toArray());

    }

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->instance = new StoreProductRequest();
    }

}
