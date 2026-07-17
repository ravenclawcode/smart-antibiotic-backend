<?php

namespace App\Repositories\Api;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function onboarding(array $data)
    {
        if (
            User::where(
                'uuid',
                $data['uuid']
            )->exists()
        ) {

            return null;
        }

        return DB::transaction(function () use ($data) {
            $user = User::create([
                'uuid'   => $data['uuid'],
                'name'   => $data['name'],

            ]);

            $user->preference()->create([
                'reminder_type' => $data['reminder_type'],
                'reminder_sound' => $data['reminder_sound'],
                'pre_reminder_minutes' => 30
            ]);

            return $user->load(
                'preference'
            );
        });
    }

    public function existsByUuid(
        string $uuid
    ): bool {
        return User::where(
            'uuid',
            $uuid
        )->exists();
    }

    public function getProfile(
        string $uuid
    ) {
        return User::where(
            'uuid',
            $uuid
        )->firstOrFail();
    }

    public function updateProfile(
        string $uuid,
        array $data
    ) {
        $user = User::where(
            'uuid',
            $uuid
        )->firstOrFail();

        $user->update([
            'name' => $data['name'],
            'age' => $data['age'],
            'gender' => $data['gender']
        ]);

        return $user->fresh();
    }
}
