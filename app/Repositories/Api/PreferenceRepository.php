<?php

namespace App\Repositories\Api;

use App\Models\User;

class PreferenceRepository
{
    public function show(string $uuid)
    {
        return User::where(
            'uuid',
            $uuid
        )
            ->with('preference')
            ->firstOrFail()
            ->preference;
    }

    public function update(
        string $uuid,
        array $data
    ) {
        $user = User::where(
            'uuid',
            $uuid
        )->firstOrFail();

        $preference = $user->preference;

        $preference->update([
            'reminder_type' => $data['reminder_type'],
            'reminder_sound' => $data['reminder_sound'],
        ]);

        return $preference->fresh();
    }
}
