<?php

/**
 * AdminAuthenticationTest
 *
 * Verifies the actual Admin authentication lifecycle on the `admin` guard
 * (/admin/login, session authentication, guest redirection, logout, and Spatie
 * permission authorization) as well as public localized homepage accessibility.
 */

declare(strict_types=1);

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Ensure the admin login screen (/admin/login) renders with HTTP 200.
     */
    public function test_admin_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
    }

    /**
     * Ensure an administrator can authenticate via the `admin` guard and is redirected to the dashboard.
     */
    public function test_admin_can_authenticate_using_the_admin_guard_and_redirect_to_dashboard(): void
    {
        $admin = User::factory()->create([
            'email' => 'abdelrahman@portfolio.test',
            'password' => Hash::make('SecretPass123!'),
            'is_admin' => true,
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'abdelrahman@portfolio.test',
            'password' => 'SecretPass123!',
        ]);

        $this->assertAuthenticatedAs($admin, 'admin');
        $response->assertRedirect('/admin');
    }

    /**
     * Ensure unauthenticated guests are redirected to /admin/login when accessing the admin dashboard.
     */
    public function test_unauthenticated_guest_is_redirected_to_admin_login(): void
    {
        $this->refreshApplicationWithLocale('ar');

        $response = $this->get('/ar/admin');

        $response->assertRedirect('/admin/login');
    }

    /**
     * Ensure an authenticated administrator can log out and invalidate their session.
     */
    public function test_authenticated_admin_can_logout(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin, 'admin')->post('/logout');

        $this->assertGuest('admin');
        $response->assertRedirect('/admin');
    }

    /**
     * Ensure an authenticated user without required Spatie permissions receives 403 Forbidden on protected routes.
     */
    public function test_user_without_permission_receives_403_on_protected_admin_route(): void
    {
        $this->refreshApplicationWithLocale('ar');

        Permission::query()->firstOrCreate([
            'name' => 'messages.view_all',
            'guard_name' => 'admin',
        ]);

        Role::query()->firstOrCreate([
            'name' => 'Restricted Editor',
            'guard_name' => 'admin',
        ]);

        $unauthorizedAdmin = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($unauthorizedAdmin, 'admin')
            ->get('/ar/admin/message');

        $response->assertStatus(403);
    }

    /**
     * Ensure the public portfolio homepage redirects to the localized route (/ar or /en) and returns HTTP 200.
     */
    public function test_public_homepage_redirects_to_locale_and_returns_200(): void
    {
        $redirectResponse = $this->get('/');
        $redirectResponse->assertRedirect();

        $this->refreshApplicationWithLocale('ar');
        $arResponse = $this->get('/ar');
        $arResponse->assertStatus(200);

        $this->refreshApplicationWithLocale('en');
        $enResponse = $this->get('/en');
        $enResponse->assertStatus(200);
    }
}
