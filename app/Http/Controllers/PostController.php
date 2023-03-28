<?php

namespace App\Http\Controllers;

use App\Http\Resources\DetailPostResourc;
use App\Http\Resources\PostResourc;
use App\Models\post;
use App\Models\search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(){
        $posts = post :: all();
        return PostResourc::collection($posts);
        // return DetailPostResourc::collection($posts->loadMissing('writer:id,username', 'comments:id,post_id,user_id,comments_content'));
    }

    public function show($id)
    {
        $post = Post::with('writer:id,username', 'comments:id,post_id,user_id,comments_content')->findOrFail($id);
        return new DetailPostResourc($post);
    }
    
    public function detail($id)
    {
        $post = Post::with('writer:id,username')->findOrFail($id);
        return new DetailPostResourc($post);
    }

    

    public function store(Request $request)
    {
        $img = validator($request->all(),[
            'file' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);
        
        $content = validator($request->all(),[
            'content' => 'required',
        ]);
        
        $title = validator($request->all(),[
            'title' => 'required|max:225',
        ]);
        
        if ($img->fails())
        {
        return response()->json([
            'message' => 'File yang anda masukkan tidak sesuai (png,jpg,jpeg)'
        ],400);
        }
        
        if ($content->fails())
        {
        return response()->json([
            'message' => 'Mohon isi di bagian content'
        ],400);
        }
        
        if ($title->fails())
        {
        return response()->json([
            'message' => 'Mohon di isi di bagian title'
        ],400);
        }

        $image = null;

        if ($request->file) {
            $fileName = $this ->generateRandomString();
            $extension = $request->file->extension();

            $image = $fileName. '.' .$extension;
            Storage::putFileAs('image', $request->file, $image);
        }

        $request['image'] = $image;
        $request['author'] = Auth::user()->id;

        $post = Post::create($request->all());
        return new DetailPostResourc($post->loadMissing('writer:id,username'));
    }

    public function update(Request $request, $id){
        $validator = validator($request->all(),[
            'title' => 'required|max:225',
            'content' => 'required',
            'file' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);
        
        if ($validator->fails())
        {
        return response()->json([
            'message' => 'File yang anda masukkan tidak sesuai (png,jpg,jpeg)'
        ],400);
        }

        $image = null;

        if ($request->file) {
            $fileName = $this ->generateRandomString();
            $extension = $request->file->extension();

            $image = $fileName. '.' .$extension;
            Storage::putFileAs('image', $request->file, $image);
        }

        $request['image'] = $image;
        $post = Post::findOrFail($id);
        $post->update($request->all());

        // return response()->json('sudah dapat di gunakan');
        return new DetailPostResourc($post->loadMissing('writer:id,username'));

    }

    public function delete($id)
    {
        $post = post::findOrFail($id);
        $post->delete();

        return response()->json([
            'messages' => 'Data berhasil di hapus'
        ]);
    }

    function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function search($title)
    {
        $result = search::where('title', 'LIKE', '%'. $title. '%')->get();
        if(count($result)){
         return Response()->json($result);
        }
        else
        {
        return response()->json(['Result' => 'No Data not found'], 404);
      }
    }
}