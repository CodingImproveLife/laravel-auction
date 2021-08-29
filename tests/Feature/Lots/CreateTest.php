<?php

namespace Tests\Feature\Lots;

use App\Models\Category;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $category;
    private $lot;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
        $this->lot = Lot::factory()->create([
            'user_id' => $this->user->id,
        ]);
    }

    public function test_user_can_create_a_lot()
    {
        $response = $this->actingAs($this->user)->get('/lots/create');

        $response->assertStatus(200);
    }

    public function test_user_can_store_the_lot()
    {
        $response = $this->actingAs($this->user)->post('/lots', [
            'title' => 'title',
            'description' => 'description',
            'category' => $this->category->id,
            'price' => 10,
        ]);

        $response->assertSessionHas('success', 'Lot created successfully.');
    }

    public function test_user_can_open_the_lot_creation_page()
    {
        $response = $this->actingAs($this->user)->get('/lots/' . $this->lot->id);

        $response->assertStatus(200);
    }
}
