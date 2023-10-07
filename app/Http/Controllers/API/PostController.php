<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts=PostResource::collection(Post::all());
       return response()->json([
           'message'=>'success',
           'data'=>$posts,
       ],200) ;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request The request object for the function
     * @throws None
     * @return \Illuminate\Http\JsonResponse The JSON response containing the data and status code
     */
    public function store(PostRequest $request)
    {
        // Validate the request data
        $validatedData = $request->validated();
        $validatedData['user_id'] = $request->user()->id;
        if($request->hasFile('image'))
        {
            $path=$request->file('image')->store('images');
            $validatedData['image'] = $path;
        }
        $post=Post::create($validatedData);
        $data=[
            'message'=>'success',
            'post'=>$post
        ];
        return response()->json($data, 201);

    }
    public function update(UpdatePostRequest $request, Post $post)
    {
       
        $validatedData = $request->validated();
       
        if($request->hasFile('image'))
        {
            $path=$request->file('image')->store('images');
            $validatedData['image'] = $path;
            if(!empty($post->image))
            {
                Storage::delete($post->image);
            }
        }
        $post->update($validatedData);
        $data=[
            'message'=>'success',
            'post'=>$post
        ];
        return response()->json($data, 200);
    }
    public function show(Post $post)
    {
        $post=new PostResource($post);
        $data=[
            'message'=>'success',
            'post'=>$post
        ];
        return response()->json($data, 200);
    }
    public function destroy(Post $post,Request $request)
    {
        if($request->user()->id!=$post->user_id)
        {
            return response()->json(['message'=>'error','data'=>'Unauthorized'],401);
        }
        if(!empty($post->image))
        {
            Storage::delete($post->image);
        }

        $post->delete();
        $data=[
            'message'=>'success',
           
        ];
        return response()->json($data, 200);
    }
    public function post_category($id)
    {
        $posts=PostResource::collection(Post::where('category_id',$id)->get());
        return response()->json([
            'message'=>'success',
            'data'=>$posts
        ],200);
    }
}
