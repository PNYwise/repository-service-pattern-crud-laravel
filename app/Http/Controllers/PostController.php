<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;

use App\Traits\ResultBuilder;


/**
 * Welcome to controller layer.
 * -----------------------------------------------------------------
 * 
 * This layer only handle a request and sending response from route, you can't write 
 * a logic,validation and filtering. And you can't comunicating with "model" and
 * "repository" here, only sending and getting data from route and service 
 * 
 */

class PostController extends Controller
{
    use ResultBuilder;
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        try {
            //get all data from post service
            $result = $this->postService->getAll();
        } catch (\Exception $e) {
            $result = ResultBuilder::error($e->getMessage(), $e->getCode());
        }
        // return $result;
        return response()->json($result, $result['code']);
    }


    public function store(Request $request)
    {
        try {
            //passing data from to/from service layer
            $result = $this->postService->create($request);
        } catch (\Exception $e) {
            $result = ResultBuilder::error($e->getMessage(), $e->getCode());
        }
        return response()->json($result, $result['code']);
    }


    public function show($id)
    {
        try {
            //get single data from post service with id param
            $result = $this->postService->getById($id);
        } catch (\Exception $e) {
            $result = ResultBuilder::error($e->getMessage(), $e->getCode());
        }
        return response()->json($result, $result['code']);
    }


    public function update(Request $request, $id)
    {
        try {
            //passing data from to/from service layer with id param
            $result = $this->postService->update($id, $request);
        } catch (\Exception $e) {
            $result = ResultBuilder::error($e->getMessage(), $e->getCode());
        }
        return response()->json($result, $result['code']);
    }


    public function destroy($id)
    {
        try {
            //passing id from to/from service layer
            $result = $this->postService->delete($id);
        } catch (\Exception $e) {
            $result = ResultBuilder::error($e->getMessage(), $e->getCode());
        }
        return response()->json($result, $result['code']);
    }
}
