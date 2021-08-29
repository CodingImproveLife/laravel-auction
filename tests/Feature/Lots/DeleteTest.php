<?php

namespace Tests\Feature\Lots;

use App\Models\Category;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    private $admin;
    private $owner;
    private $nonOwner;
    private $lot;

    public function setUp(): void
    {
        parent::setUp();

        Permission::create(['name' => 'edit lots']);
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin');
        $this->owner = User::factory()->create();
        $this->nonOwner = User::factory()->create();

        Category::factory()->create();
        $this->lot = Lot::factory()->create([
            'user_id' => $this->owner->id,
        ]);
    }

    public function test_user_can_delete_the_lot()
    {
        $response = $this->actingAs($this->owner)->delete('/lots/' . $this->lot->id);

        $response->assertSessionHas('success', 'Lot delete successfully.');
    }

    public function test_admin_can_delete_the_lot()
    {
        $response = $this->actingAs($this->admin)->delete('/lots/' . $this->lot->id);

        $response->assertSessionHas('success', 'Lot delete successfully.');
    }

    public function test_non_owner_cannot_delete_the_lot()
    {
        $response = $this->actingAs($this->nonOwner)->delete('/lots/' . $this->lot->id);

        $response->assertForbidden();
    }

    public function test_unauthorized_user_is_redirected_to_the_login_page()
    {
        $response = $this->delete('/lots/' . $this->lot->id);

        $response->assertLocation('/login');
    }
}
