<?php

namespace App\Services;

use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Traits\ResultBuilder;
use Illuminate\Support\Facades\Validator;


/**
 * Welcome to service layer.
 * -----------------------------------------------------------------
 * 
 * Here, you can write many "logic", "validate", "filter" before you sending
 * and getting data from "controller" to "repository". But here,you can't 
 * comunicating  with "models",only with "controller" and "repository".
 * 
 */


class PostService
{
     use ResultBuilder;
     private PostRepositoryInterface $postRepository;

     public function __construct(PostRepositoryInterface $postRepository)
     {
          $this->postRepository = $postRepository;
     }

     public function getAll()
     {
          //getting data from repository
          $data =  $this->postRepository->getAll();
          return ResultBuilder::success('data found', $data, 200);
     }

     public function getById($id)
     {
          //getting data from repository
          $data = $this->postRepository->getById($id);
          if (is_null($data)) {
               return ResultBuilder::error('id not found', 404);
          }
          return ResultBuilder::success('data found', $data, 200);
     }

     public function create($data)
     {
          //sending data to repository
          $selectedData = $data->only(['title', 'body', 'user_id', 'category_id']);
          $validationData = Validator::make($selectedData, [
               'title' => 'required',
               'body' => 'required',
               'user_id' => 'required',
               'category_id' => 'required'
          ]);
               if ($validationData->fails()) {
                    return ResultBuilder::error($validationData->getMessageBag(), 400);
               }

          $data = $this->postRepository->create($selectedData);
          return ResultBuilder::success('Data has been added', $data, 201);
     }

     public function update($id, $data)
     {
          //is_null logic to hendle 404 error
          $validator = Validator::make($data, [
               'full_name' => 'required|min:4',
               'address' => 'required',
               'phone' => 'required',
          ]);
          if (is_null($this->postRepository->getById($id))) {
               //returning an array data with error massage to controller
               return ResultBuilder::error('id not found', 404);
          }

          //sending data to repository
          $selectedData = $data->only(['title', 'body', 'category_id']);
          $data = $this->postRepository->update($id, $selectedData);
          return ResultBuilder::success('Data has been updated', $data, 200);
     }

     public function delete($id)
     {
          if (is_null($this->postRepository->getById($id))) {
               return ResultBuilder::error('id not found', 404);
          }

          $data = $this->postRepository->delete($id);
          return ResultBuilder::success('Data has been deleted', $data, 204);
     }
}
