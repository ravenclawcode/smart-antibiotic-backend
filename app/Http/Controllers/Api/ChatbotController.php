<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChatbotMessageRequest;
use App\Services\Api\ChatbotService;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function __construct(
        protected ChatbotService $service
    ) {}

    public function session(Request $request)
    {
        $user = $request->attributes->get('user');

        return response()->json([
            'success' => true,
            'data' => $this->service->session(
                $user->id
            )
        ]);
    }

    public function send(
        ChatbotMessageRequest $request
    ) {
        $user = $request->attributes->get('user');

        return response()->json([
            'success' => true,
            'data' => $this->service->sendMessage(
                $user->id,
                $request->message
            )
        ]);
    }

    public function destroy(Request $request)
    {
        $user = $request->attributes->get('user');

        $this->service->delete(
            $user->id
        );

        return response()->json([
            'success' => true,
            'message' => 'Percakapan berhasil dihapus.'
        ]);
    }
}
