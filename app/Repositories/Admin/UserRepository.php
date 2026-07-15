<?php

namespace App\Repositories\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function getAll()
    {
        return User::with(
            'preference'
        )
            ->latest()
            ->paginate(10);
    }

    public function find(
        User $user
    ) {
        return $user->load(
            'preference'
        );
    }

    // public function onboarding(array $data)
    // {
    //     if (
    //         User::where(
    //             'uuid',
    //             $data['uuid']
    //         )->exists()
    //     ) {

    //         return null;
    //     }

    //     return DB::transaction(function () use ($data) {
    //         $user = User::create([
    //             'uuid'   => $data['uuid'],
    //             'name'   => $data['name'],
    //             'age'    => $data['age'],
    //             'gender' => $data['gender'],

    //         ]);

    //         $user->preference()->create([
    //             'reminder_type' => $data['reminder_type'],
    //             'reminder_sound' => $data['reminder_sound'],
    //             'pre_reminder_minutes' => 5
    //         ]);

    //         return $user->load(
    //             'preference'
    //         );
    //     });
    // }

    // public function findByUuid(
    //     string $uuid
    // ) {
    //     return User::with('preference')
    //         ->where(
    //             'uuid',
    //             $uuid
    //         )
    //         ->first();
    // }

    // public function getProfile(
    //     string $uuid
    // ) {
    //     return User::with(
    //         'preference'
    //     )
    //         ->where(
    //             'uuid',
    //             $uuid
    //         )
    //         ->firstOrFail();
    // }

    // public function updateProfile(
    //     string $uuid,
    //     array $data
    // ) {
    //     $user = User::where(
    //         'uuid',
    //         $uuid
    //     )->firstOrFail();

    //     $user->update([

    //         'name' => $data['name'],

    //         'age' => $data['age'],

    //         'gender' => $data['gender']

    //     ]);

    //     return $user->fresh(
    //         'preference'
    //     );
    // }
}
