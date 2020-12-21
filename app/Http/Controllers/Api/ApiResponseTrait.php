<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostResource;

trait ApiResponseTrait
{
    /**
     * api response 
     * [
     *  'data'=> data,
     *  'status'=> true or false,
     *  'message' => 'string message, error or success'
     * ]
     * 
     */

    public $paginateNumber = 3;

    public function apiResponse($data = null, $error = null, $code = 200)
    {
        $array = [
            'data' => $data,
            'status' => in_array($code, $this->successCode()) ? true : false,
            'message' => $error
        ];
        return response($array, $code);
    }

    public function successCode()
    {
        return [200, 201, 202];
    }

    public function notFoundResponse()
    {
        return $this->apiResponse(null, 'Not Found!', 404);
    }

    public function apiValidation($request, $array){
        $validator = Validator::make($request->all(), $array);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 422);
        }

    }

    //unKnown Error Functio
    public function unknownError(){
        return $this->apiResponse(null, 'UnKnown Error', 400);
    }

    //success response for store post
    public function createdResponse($data){
        return $this->apiResponse(new PostResource($data), null, 201);
    }

    //success response for Delete post
    function deleteResponse(){
        return $this->apiResponse(true, 'deleted was succeded', 200);

    }

}
