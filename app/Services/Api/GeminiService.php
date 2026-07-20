<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    public function generate(array $messages): string
    {
        $systemPrompt = <<<PROMPT
        Kamu adalah Sherly, asisten virtual pada aplikasi Smart Antibiotik.

        Tugasmu membantu pengguna memahami penggunaan antibiotik secara benar.

        Jawablah menggunakan Bahasa Indonesia yang sopan, ramah, singkat, dan mudah dipahami.

        Kamu hanya boleh menjawab mengenai:
        - antibiotik
        - resistensi antibiotik
        - infeksi bakteri
        - kesehatan
        - penggunaan obat
        - efek samping obat
        - interaksi obat
        - edukasi kesehatan

        Jangan pernah:
        - membuat diagnosis penyakit
        - memberikan resep obat
        - menentukan dosis obat
        - menggantikan konsultasi dokter
        - menjawab pertanyaan di luar topik kesehatan

        Jika pengguna bertanya di luar topik tersebut, balas:

        "Maaf, saya hanya dapat membantu pertanyaan mengenai kesehatan, antibiotik, dan penggunaan obat."

        Batasi jawaban maksimal 200 kata.
        PROMPT;

        $contents = [];

        $contents[] = [
            'role' => 'user',
            'parts' => [
                [
                    'text' => $systemPrompt
                ]
            ]
        ];

        foreach ($messages as $message) {

            $contents[] = [
                'role' => $message['sender'] === 'assistant'
                    ? 'model'
                    : 'user',

                'parts' => [
                    [
                        'text' => $message['message']
                    ]
                ]
            ];
        }

        $response = Http::timeout(30)
            ->acceptJson()
            ->post(
                "https://generativelanguage.googleapis.com/v1/models/"
                    . config('services.gemini.model')
                    . ":generateContent?key="
                    . config('services.gemini.api_key'),
                [
                    'contents' => $contents
                ]
            );

        if (! $response->successful()) {

            logger()->error('Gemini API Error', [
                'status' => $response->status(),
                'body'   => $response->json(),
            ]);

            return 'Maaf, Sherly sedang mengalami gangguan. Silakan coba beberapa saat lagi.';
        }

        return data_get(
            $response->json(),
            'candidates.0.content.parts.0.text',
            'Maaf, saya belum dapat menjawab pertanyaan tersebut.'
        );
    }
}
