<?php

use App\Models\User;
use function Pest\Laravel\{get};

test('if auth middleware is working', function () {
    get(route('portal:dashboard'))->assertRedirect(route('login'));
    get(route('profile.show'))->assertRedirect(route('login'));

    $user = User::factory()->create();
    actingAs($user)->get('/portal')->assertStatus(200);
    actingAs($user)->get(route('profile.show'))->assertStatus(200);

    actingAs($user)->get(route('login'))->assertRedirect(route('portal:dashboard'));
    actingAs($user)->get(route('register'))->assertRedirect(route('portal:dashboard'));
    actingAs($user)->get(route('password.request'))->assertRedirect(route('portal:dashboard'));
});

test('if admin middleware is working', function () {
    get(route('admin:users.index'))->assertRedirect(route('login'));
    get(route('admin:teams.index'))->assertRedirect(route('login'));
    get(route('admin:meets.index'))->assertRedirect(route('login'));
    get(route('admin:meets.create'))->assertRedirect(route('login'));
    get(route('admin:locations.index'))->assertRedirect(route('login'));
    get(route('admin:locations.create'))->assertRedirect(route('login'));
    get(route('admin:contacts.index'))->assertRedirect(route('login'));
    get(route('admin:contacts.create'))->assertRedirect(route('login'));

    $admin = User::factory()->create();

//    actingAs($admin)->get(route('admin:users.index'))->assertStatus(200);
//    actingAs($admin)->get(route('admin:teams.index'))->assertStatus(200);
//    actingAs($admin)->get(route('admin:meets.index'))->assertStatus(200);
//    actingAs($admin)->get(route('admin:meets.create'))->assertStatus(200);
//    actingAs($admin)->get(route('admin:locations.index'))->assertStatus(200);
//    actingAs($admin)->get(route('admin:locations.create'))->assertStatus(200);
//    actingAs($admin)->get(route('admin:contacts.index'))->assertStatus(200);
//    actingAs($admin)->get(route('admin:contacts.create'))->assertStatus(200);
});

test('portal has page as user', function () {
    actingAs($user = User::factory()->create())
        ->get('/portal')
        ->assertStatus(200);
});
