<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReturnFormSubmissionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the return form correctly routes to the return endpoint
     * and processes a return submission with condition "baik"
     */
    public function test_return_form_submission_with_baik_condition(): void
    {
        // Create users
        $peminjam = User::factory()->create(['role' => 'peminjam']);
        
        // Create a peminjaman with "disetujui" status
        $peminjaman = Peminjaman::factory()->create([
            'user_id' => $peminjam->id,
            'status' => 'disetujui',
        ]);

        // Login as peminjam
        $this->actingAs($peminjam);

        // Submit return form with "baik" condition
        $response = $this->post(
            route('peminjam.peminjamans.return', $peminjaman),
            ['kondisi_alat' => 'baik']
        );

        // Assert form posted to correct route
        $this->assertNotNull($response);
        
        // Assert redirect to dashboard
        $response->assertRedirect(route('peminjam.dashboard'));

        // Assert pengembalian record was created
        $this->assertDatabaseHas('pengembalians', [
            'peminjaman_id' => $peminjaman->id,
            'kondisi_alat' => 'baik',
            'denda' => 0,
        ]);

        // Assert peminjaman status updated to "selesai"
        $this->assertDatabaseHas('peminjamans', [
            'id' => $peminjaman->id,
            'status' => 'selesai',
        ]);
    }

    /**
     * Test return form submission with "rusak" condition
     * and verify dual logging is created
     */
    public function test_return_form_submission_with_rusak_condition(): void
    {
        // Create users
        $peminjam = User::factory()->create(['role' => 'peminjam']);
        
        // Create a peminjaman with "disetujui" status
        $peminjaman = Peminjaman::factory()->create([
            'user_id' => $peminjam->id,
            'status' => 'disetujui',
        ]);

        // Login as peminjam
        $this->actingAs($peminjam);

        // Submit return form with "rusak" condition
        $response = $this->post(
            route('peminjam.peminjamans.return', $peminjaman),
            ['kondisi_alat' => 'rusak']
        );

        // Assert form posted successfully
        $this->assertNotNull($response);
        
        // Assert pengembalian record was created with correct denda
        $this->assertDatabaseHas('pengembalians', [
            'peminjaman_id' => $peminjaman->id,
            'kondisi_alat' => 'rusak',
            'denda' => 100000, // Rp 100.000 untuk rusak
        ]);

        // Assert dual logging was created:
        // 1. Standard log with [ALERT] tag
        $this->assertDatabaseHas('log_aktivitass', [
            'user_id' => $peminjam->id,
            'aktivitas' => 'Kembalikan Peminjaman',
        ]);

        // 2. Alert log for admin/petugas
        $this->assertDatabaseHas('log_aktivitass', [
            'user_id' => $peminjam->id,
            'aktivitas' => '⚠ ALERT: Alat Rusak',
        ]);
    }

    /**
     * Test that user cannot return someone else's peminjaman
     */
    public function test_cannot_return_other_users_peminjaman(): void
    {
        // Create two users
        $peminjam1 = User::factory()->create(['role' => 'peminjam']);
        $peminjam2 = User::factory()->create(['role' => 'peminjam']);
        
        // Create peminjaman owned by peminjam1
        $peminjaman = Peminjaman::factory()->create([
            'user_id' => $peminjam1->id,
            'status' => 'disetujui',
        ]);

        // Login as peminjam2
        $this->actingAs($peminjam2);

        // Try to submit return
        $response = $this->post(
            route('peminjam.peminjamans.return', $peminjaman),
            ['kondisi_alat' => 'baik']
        );

        // Assert access denied
        $response->assertRedirect();
        $response->assertSessionHas('error');
    }

    /**
     * Test that return route requires authentication
     */
    public function test_return_route_requires_authentication(): void
    {
        $peminjaman = Peminjaman::factory()->create([
            'status' => 'disetujui',
        ]);

        // Try to post without authentication
        $response = $this->post(
            route('peminjam.peminjamans.return', $peminjaman),
            ['kondisi_alat' => 'baik']
        );

        // Assert redirected to login
        $response->assertRedirect(route('login'));
    }
}
