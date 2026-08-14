<?php

namespace App\Services\Admin;

use App\Models\Antibiotic;
use App\Repositories\Admin\AntibioticRepository;
use App\Services\Api\YouTubeService;
use Illuminate\Support\Facades\Storage;

class AntibioticService
{
    protected AntibioticRepository $repository;

    protected YouTubeService $youtubeService;

    public function __construct(
        AntibioticRepository $repository,
        YouTubeService $youtubeService
    ) {
        $this->repository = $repository;
        $this->youtubeService = $youtubeService;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function create(array $data)
    {

        if (!empty($data['image'])) {
            $data['image'] = $data['image']->store(
                'antibiotics',
                'public'
            );
        }

        if (!empty($data['video_url'])) {

            $youtube = $this->youtubeService
                ->getMetadata($data['video_url']);

            $data['video_title'] = $youtube['video_title'];
            $data['video_duration'] = $youtube['video_duration'];
            $data['video_thumbnail'] = $youtube['video_thumbnail'];
        }

        return $this->repository->create($data);
    }

    public function update(
        Antibiotic $antibiotic,
        array $data
    ) {

        if (!empty($data['image'])) {

            if ($antibiotic->image) {
                Storage::disk('public')
                    ->delete($antibiotic->image);
            }

            $data['image'] = $data['image']->store(
                'antibiotics',
                'public'
            );
        }

        if (!empty($data['video_url'])) {

            $youtube = $this->youtubeService
                ->getMetadata($data['video_url']);

            $data['video_title'] = $youtube['video_title'];
            $data['video_duration'] = $youtube['video_duration'];
            $data['video_thumbnail'] = $youtube['video_thumbnail'];
        }

        return $this->repository->update(
            $antibiotic,
            $data
        );
    }

    public function delete(Antibiotic $antibiotic)
    {
        if ($antibiotic->image) {
            Storage::disk('public')
                ->delete($antibiotic->image);
        }

        return $this->repository->delete($antibiotic);
    }
}
