<?php

namespace App\Repositories\Api;

use App\Models\User;

class PreferenceRepository
{
    public function show(int $userId)
    {
        return User::with(
            'preference'
        )
            ->findOrFail(
                $userId
            )
            ->preference;
    }

    public function update(
        int $userId,
        array $data
    ) {
        $user = User::findOrFail(
            $userId
        );

        $preference = $user->preference;

        $preference->update([
            'reminder_type' => $data['reminder_type'],
            'reminder_sound' => $data['reminder_sound'],
        ]);

        return $preference->fresh();
    }
}
