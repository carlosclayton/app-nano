<?php

namespace App\Services;

use App\Repositories\Interface\PostRepositoryInterface;

class PostService
{
    private $repository;

    public function __construct(
        PostRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function get($id)
    {
        return $this->repository->get($id);
    }

    public function store($request)
    {
        $rules = function () use ($request) {
            $data = [
                'title' => $request->input('title'),
                'body' => $request->input('body'),
            ];

            return $this->repository->store($data);
        };

    }

    public function update($request, $id)
    {
        $rules = function () use ($request) {
            $data = [
                'title' => $request->input('title'),
                'body' => $request->input('body'),
            ];

            return $this->repository->update($data);
        };
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
