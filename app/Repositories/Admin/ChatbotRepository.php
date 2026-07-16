<?php

namespace App\Repositories\Admin;

use App\Models\ChatSession;

class ChatbotRepository
{
    public function latestSession(int $userId)
    {
        return ChatSession::with('messages')
            ->where('user_id', $userId)
            ->latest()
            ->first();
    }

    public function createSession(int $userId)
    {
        return ChatSession::create([
            'user_id' => $userId,
            'title' => 'Percakapan ' . now()->format('d M Y')
        ]);
    }

    public function addMessage(
        ChatSession $session,
        string $sender,
        string $message
    ) {

        return $session->messages()->create([
            'sender' => $sender,
            'message' => $message
        ]);
    }

    public function delete(ChatSession $session)
    {
        return $session->delete();
    }
}
