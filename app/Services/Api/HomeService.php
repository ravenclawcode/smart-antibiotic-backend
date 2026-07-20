<?php

namespace App\Services\Api;

use App\Repositories\Api\HomeRepository;

class HomeService
{
    public function __construct(
        protected HomeRepository $repository
    ) {}

    public function home(
        int $userId,
        ?string $date
    ) {
        return $this->repository->home(
            $userId,
            $date
        );
    }
}
