<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_loads(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Peminjaman Alat');
    }

    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->admin()->create([
            'username' => 'admin',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'username' => 'admin',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_invalid_credentials(): void
    {
        User::factory()->admin()->create([
            'username' => 'admin',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'username' => 'admin',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors('login');
    }

    public function test_admin_redirects_to_admin_dashboard(): void
    {
        $user = User::factory()->admin()->create();

        $response = $this->actingAs($user)->get('/admin/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Admin');
    }

    public function test_petugas_redirects_to_petugas_dashboard(): void
    {
        $user = User::factory()->petugas()->create();

        $response = $this->actingAs($user)->get('/petugas/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Petugas');
    }

    public function test_peminjam_redirects_to_peminjam_dashboard(): void
    {
        $user = User::factory()->peminjam()->create();

        $response = $this->actingAs($user)->get('/peminjam/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Peminjam');
    }

    public function test_user_cannot_access_admin_dashboard_without_admin_role(): void
    {
        $user = User::factory()->peminjam()->create();

        $response = $this->actingAs($user)->get('/admin/dashboard');
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
}
