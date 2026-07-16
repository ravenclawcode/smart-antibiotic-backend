<?php

namespace App\Services\Admin;

use App\Repositories\Admin\ChatbotRepository;
use App\Services\Admin\GeminiService;

class ChatbotService
{
    public function __construct(
        protected ChatbotRepository $repository,
        protected GeminiService $gemini
    ) {}

    public function session(int $userId)
    {
        $session = $this->repository
            ->latestSession($userId);

        if (!$session) {

            $session = $this->repository
                ->createSession($userId);

            $this->repository->addMessage(
                $session,
                'assistant',
                'Hai! Saya Sherly. Ada yang bisa aku bantu hari ini?'
            );

            $session->load('messages');
        }

        return $session;
    }

    public function sendMessage(
        int $userId,
        string $message
    ) {
        $session = $this->session($userId);

        $this->repository->addMessage(
            $session,
            'user',
            $message
        );

        $session->load('messages');

        $history = $session->messages
            ->map(function ($item) {

                return [
                    'sender' => $item->sender,
                    'message' => $item->message
                ];
            })
            ->toArray();

        $reply = $this->gemini
            ->generate($history);

        $assistant = $this->repository->addMessage(
            $session,
            'assistant',
            $reply
        );

        return $assistant;
    }
}
