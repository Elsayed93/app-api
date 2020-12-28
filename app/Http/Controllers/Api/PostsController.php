<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $posts = PostResource::collection(Post::paginate(3));
        // $posts = new PostResource(Post::all());
        // dd($posts);
        return $this->apiResponse($posts);
    }

    //show post with id
    public function show($id)
    {
        $post = new PostResource(Post::find($id));
        // dd($post);
        if ($post->resource) {
            // return response($post, 200);
            return $this->succesResponse($post);

        } else {
            return $this->notFoundResponse();
        }
    }

    //Store post 
    public function store(Request $request)
    {

        // if (!$request->has('title') && $request->get('title') == '') {
        //     return $this->apiResponse(null, 'invalid unput, title is required', 422);
        // }

        // if (!$request->has('body') && $request->get('body') == '') {
        //     return $this->apiResponse(null, 'invalid unput, body is required', 422);
        // }

        // $validator = Validator::make($request->all(), [
        //     'title' => 'required',
        //     'body' => 'required'
        // ]);
        // dd($request->all());

        $validation = $this->validation($request);

        if ($validation instanceof Response) {
            return $validation;
        }

        // if ($validator->fails()) {
        //     return $this->apiResponse(null, $validator->errors(), 422);
        // }

        $post = Post::create($request->all());
        // dd($post);
        if ($post) {
            return $this->createdResponse($post);
        }

        return $this->unknownError();
    }

    //Update post 
    public function update($id, Request $request)
    {
        // validate the request,, 
        $validation = $this->validation($request);

        if ($validation instanceof Response) {
            return $validation;
        }

        $post = Post::find($id);

        if (!$post) {
            return $this->notFoundResponse();
        } else {
            $post->update($request->all());

            if ($post) {
                return $this->succesResponse($post);
            }

            return $this->unknownError();
        }
    }

    //delete a post
    public function delete($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return $this->deleteResponse();
        }
        return $this->apiResponse(null, 'Not Found!', 404);
    }

    public function validation($request)
    {
        return $this->apiValidation($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
    }

    //retrun response as a post Resource
    public function succesResponse($post)
    {
        return $this->apiResponse(new PostResource($post));
    }
}
