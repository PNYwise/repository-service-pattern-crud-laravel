<?php

namespace App\Repositories\Interfaces;

interface PostRepositoryInterface
{
     public function getAll();
     public function getLatest();
     public function getById($id);
     public function create($data);
     public function update($id, $data);
     public function delete($id);
}
