<?php

use App\Models\User;
use function Pest\Laravel\{get};

test('if auth middleware is working', function () {
    get('/portal')->assertRedirect('/login');
    get('/user/profile')->assertRedirect('/login');

    $user = User::factory()->create();
    actingAs($user)->get('/portal')->assertStatus(200);
    actingAs($user)->get('/user/profile')->assertStatus(200);
});

test('if admin middleware is working', function () {
    get('/admin/users')->assertRedirect('/login');
    get('/admin/teams')->assertRedirect('/login');
    get('/admin/meets')->assertRedirect('/login');
    get('/admin/meets/create')->assertRedirect('/login');
    get('/admin/locations')->assertRedirect('/login');
    get('/admin/locations/create')->assertRedirect('/login');
    get('/admin/contacts')->assertRedirect('/login');
    get('/admin/contacts/create')->assertRedirect('/login');

    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    actingAs($admin)->get('/admin/users')->assertStatus(200);
    actingAs($admin)->get('/admin/teams')->assertStatus(200);
    actingAs($admin)->get('/admin/meets')->assertStatus(200);
    actingAs($admin)->get('/admin/meets/create')->assertStatus(200);
    actingAs($admin)->get('/admin/locations')->assertStatus(200);
    actingAs($admin)->get('/admin/locations/create')->assertStatus(200);
    actingAs($admin)->get('/admin/contacts')->assertStatus(200);
    actingAs($admin)->get('/admin/contacts/create')->assertStatus(200);
});

test('portal has page as user', function () {
    actingAs($user = User::factory()->create())
        ->get('/portal')
        ->assertStatus(200);
});
