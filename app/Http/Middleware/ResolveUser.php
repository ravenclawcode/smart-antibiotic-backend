<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResolveUser
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        $uuid = $request->header('X-User-UUID');
        if (!$uuid) {
            return response()->json([
                'success' => false,
                'message' => 'Header X-User-UUID wajib dikirim.'
            ], 400);
        }

        $user = User::where(
            'uuid',
            $uuid
        )->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan.'
            ], 404);
        }

        $request->attributes->set(
            'user',
            $user
        );
        return $next($request);
    }
}
