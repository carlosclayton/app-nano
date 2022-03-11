<?php

namespace App\Repositories\Interface;

interface PostRepositoryInterface
{
    public function getAll();
    public function store($data);
    public function get($id);
    public function update($data, $id);
    public function destroy($id);
}
