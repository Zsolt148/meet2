<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\{get};

beforeEach(fn () => $this->user = User::factory()->create());

test('has user profile page', function () {
    actingAs($this->user)
        ->get(route('profile.show'))
        ->assertStatus(200);
});

test('user can update his name', function () {

    $this->markTestSkipped(); //TODO fix me

    actingAs($user = $this->user)
        ->put(route('user-profile-information.update'), [
            'name' => 'Test Name',
            'email' => $user->email,
        ]);

    $this->assertEquals('Test Name', $user->fresh()->name);
});

test('user can update his password', function () {

    actingAs($user = $this->user)
        ->put(route('user-password.update'), [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

    $this->assertTrue(Hash::check('new-password', $user->fresh()->password));
});