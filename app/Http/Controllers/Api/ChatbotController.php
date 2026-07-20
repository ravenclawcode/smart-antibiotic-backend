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

    public function session(
        Request $request
    ) {
        return response()->json([
            'success' => true,
            'data' => $this->service->session(
                $request->user_id
            )
        ]);
    }

    public function send(
        ChatbotMessageRequest $request
    ) {
        return response()->json([
            'success' => true,
            'data' => $this->service->sendMessage(
                $request->user_id,
                $request->message
            )
        ]);
    }

    public function destroy(
        Request $request
    ) {
        $this->service->delete(
            $request->user_id
        );

        return response()->json([
            'success' => true,
            'message' => 'Percakapan berhasil dihapus.'
        ]);
    }
}
