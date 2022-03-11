<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Repositories\Interface\PostRepositoryInterface;

class PostRepositoryEloquent implements PostRepositoryInterface
{
    private $model;

    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    public function getAll()
    {
        return $this->model->orderBy('id', 'DESC')->get();
    }

    public function get($id)
    {
        return $this->model->findOrFail($id);
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function update($data, $id)
    {
        $persist = $this->model->find($id);
        $persist->update($data);
        return $persist;
    }

    public function destroy($id)
    {
        return $this->model->findOrFail($id)->delete();
    }
}
