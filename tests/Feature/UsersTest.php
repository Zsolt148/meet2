<?php

use App\Models\User;
use function Pest\Laravel\{get};

//beforeEach(fn () => User::factory()->create());

test('has user profile page', function () {
    actingAs($user = User::factory()->create())
        ->get('/user/profile')
        ->assertStatus(200);
});

test('user can update his name', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->put('/user/profile-information', [
            'name' => 'Test Name',
        ]);

    $this->assertEquals('Test Name', $user->fresh()->name);
});
