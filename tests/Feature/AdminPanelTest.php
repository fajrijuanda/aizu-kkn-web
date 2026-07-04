<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    public function test_guest_is_redirected_to_admin_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_admin_can_access_dashboard(): void
    {
        $admin = User::query()->where('role', 'admin')->firstOrFail();

        $this->actingAs($admin)->get('/admin')->assertOk();
    }

    public function test_non_admin_cannot_access_dashboard(): void
    {
        $user = User::query()->create([
            'name' => 'Non Admin',
            'email' => 'user@example.com',
            'password' => 'password',
            'role' => 'user',
            'is_active' => true,
        ]);

        $this->actingAs($user)->get('/admin')->assertForbidden();
    }
}
