<?php

namespace Http\Controllers;

use App\Models\User;
use Tests\TestCase;

/**
 * Test class for App\Http\Controllers\HomeController
 */
class HomeControllerTest extends TestCase
{
    /**
     * @test
     */
    public function testIndex(): void
    {
        $this->get(route('index'))
            ->assertSuccessful()
            ->assertViewHas('products')
            ->assertViewHas('searchData')
            ->assertSeeText('Restricted area');
    }

    /**
     * @test
     */
    public function testIndexAuthenticated(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get(route('index'))
            ->assertSuccessful()
            ->assertViewHas('products')
            ->assertViewHas('searchData')
            ->assertDontSeeText('Restricted area')
            ->assertSeeText($user->name);
    }
}
