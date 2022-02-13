<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            'isSenior' => ['nullable'],
            'team_id' => ['nullable', 'required_if:isSenior,true'],
            'other_team' => ['nullable', 'required_if:team_id,other', 'string', 'max:190'],
            'other_team_country' => ['nullable', 'required_if:team_id,other', 'string', 'max:190'],

            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'team_id' => $input['team_id'] == 'other' ? null : ($input['team_id'] ?? null),
        ]);

        if($input['isSenior']) {
            $team = Team::create([
                'name' => $input['other_team'],
                'type' => Team::TYPE_OTHER,
                'country' => $input['other_team_country'],
            ]);

            $user->update([
                'team_id' => $team->id,
            ]);
        }

        return $user;
    }
}
