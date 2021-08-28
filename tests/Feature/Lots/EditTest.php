<?php

namespace Tests\Feature\Lots;

use App\Models\Category;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    private $admin;
    private $seller;
    private $buyer;
    private $lot;

    public function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'edit lots']);
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin');
        $this->seller = User::factory()->create();
        $this->buyer = User::factory()->create();
        Category::factory()->create();
        $this->lot = Lot::factory()->create([
            'user_id' => $this->seller->id,
        ]);
    }

    public function test_admin_can_edit_the_lot()
    {
        $response = $this->actingAs($this->admin)->get('/lots/' . $this->lot->id . '/edit');

        $response->assertStatus(200);
    }

    public function test_seller_can_edit_the_lot()
    {
        $response = $this->actingAs($this->seller)->get('/lots/' . $this->lot->id . '/edit');

        $response->assertStatus(200);
    }

    public function test_bayer_cannot_edit_the_lot()
    {
        $response = $this->actingAs($this->buyer)->get('/lots/' . $this->lot->id . '/edit');

        $response->assertStatus(403);
    }
}
