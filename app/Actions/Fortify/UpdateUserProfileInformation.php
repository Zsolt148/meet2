<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            //'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2048'],

            // senior team
            'team_id' => ['nullable'],
            'other_team' => ['nullable', 'required_if:team_id,other', 'string', 'max:190'],
            'other_team_country' => ['nullable', 'required_if:team_id,other', 'string', 'max:190'],

        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        /*
        if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        }
        */

        // registering as senior
        if($input['team_id']) {

            // if he selected a team
            if($input['team_id'] && $input['team_id'] !== 'other') {

                $user->team_id = $input['team_id'];

            }elseif($input['team_id'] == 'other') {

                $team = Team::create([
                    'name' => $input['other_team'],
                    'type' => Team::TYPE_OTHER,
                    'country' => $input['other_team_country'],
                ]);

                $user->team_id = $team->id;
            }

            $user->assignRole('senior_team_leader');
        // team is is null
        }else {
            $user->team_id = null;
            $user->removeRole('senior_team_leader');
        }

        $user->forceFill([
            'name' => $input['name'],
        ]);

        $user->save();
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            //'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
