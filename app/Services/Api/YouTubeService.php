<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class YouTubeService
{
    public function getMetadata(string $url): array
    {
        $videoId = $this->extractVideoId($url);

        if (!$videoId) {
            throw new RuntimeException(
                'URL YouTube tidak valid.'
            );
        }

        $response = Http::timeout(10)->get(
            'https://www.googleapis.com/youtube/v3/videos',
            [
                'part' => 'snippet,contentDetails',
                'id' => $videoId,
                'key' => config('services.youtube.api_key'),
            ]
        );

        if (!$response->successful()) {
            throw new RuntimeException(
                'Gagal mengambil data dari YouTube.'
            );
        }

        $items = $response->json('items');

        if (empty($items)) {
            throw new RuntimeException(
                'Video YouTube tidak ditemukan.'
            );
        }

        $video = $items[0];

        $snippet = $video['snippet'] ?? [];
        $contentDetails = $video['contentDetails'] ?? [];

        return [
            'video_id' => $videoId,

            'video_title' => $snippet['title'] ?? null,

            'video_duration' => $this->formatDuration(
                $contentDetails['duration'] ?? null
            ),

            'video_thumbnail' =>
            $snippet['thumbnails']['maxres']['url']
                ?? $snippet['thumbnails']['standard']['url']
                ?? $snippet['thumbnails']['high']['url']
                ?? $snippet['thumbnails']['medium']['url']
                ?? null,
        ];
    }

    private function extractVideoId(string $url): ?string
    {
        $url = trim($url);

        if (preg_match(
            '/youtu\.be\/([a-zA-Z0-9_-]{11})/',
            $url,
            $matches
        )) {
            return $matches[1];
        }

        if (preg_match(
            '/youtube\.com\/watch\?v=([a-zA-Z0-9_-]{11})/',
            $url,
            $matches
        )) {
            return $matches[1];
        }

        if (preg_match(
            '/youtube\.com\/shorts\/([a-zA-Z0-9_-]{11})/',
            $url,
            $matches
        )) {
            return $matches[1];
        }

        if (preg_match(
            '/youtube\.com\/embed\/([a-zA-Z0-9_-]{11})/',
            $url,
            $matches
        )) {
            return $matches[1];
        }

        return null;
    }

    private function formatDuration(?string $duration): ?string
    {
        if (!$duration) {
            return null;
        }

        preg_match(
            '/PT(?:(\d+)H)?(?:(\d+)M)?(?:(\d+)S)?/',
            $duration,
            $matches
        );

        $hours = isset($matches[1])
            ? (int) $matches[1]
            : 0;

        $minutes = isset($matches[2])
            ? (int) $matches[2]
            : 0;

        $seconds = isset($matches[3])
            ? (int) $matches[3]
            : 0;

        if ($hours > 0) {
            return sprintf(
                '%d:%02d:%02d',
                $hours,
                $minutes,
                $seconds
            );
        }

        return sprintf(
            '%02d:%02d',
            $minutes,
            $seconds
        );
    }
}
