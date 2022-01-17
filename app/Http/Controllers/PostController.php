<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        /* $posts = auth()->user()->posts()->paginate(5); */
        return view("admin.posts.index", ["posts" => $posts]);
    }
    public function show(Post $post)
    {
        return view("blog-post", ["post" => $post]);
    }
    public function create()
    {
        $this->authorize("create", Post::class);
        return view("admin.posts.create");
    }
    public function store()
    {
        $this->authorize("create", Post::class);
        $inputs = request()->validate([
            "title" => "required|min:8|max:255",
            "post_image" => "file",
            "body" => "required"
        ]);

        if (request("post_image")) {
            $inputs["post_image"] = request("post_image")->store("images");
        }
        auth()->user()->posts()->create($inputs);

        return redirect()->route("post.index");
        Session::flash("post-created-message", "Post with title was created " . $inputs["title"]);
    }

    public function edit(Post $post)
    {
        $this->authorize("view", $post);
        return view("admin.posts.edit", ["post" => $post]);
    }

    public function update(Post $post)
    {
        $inputs = request()->validate([
            "title" => "required|min:8|max:255",
            "post_image" => "file",
            "body" => "required"
        ]);

        if (request("post_image")) {
            $inputs["post_image"] = request("post_image")->store("images");
            $post->post_image = $inputs["post_image"];
        }

        $post->title = $inputs["title"];
        $post->body = $inputs["body"];

        $this->authorize("update", $post);

        $post->save();

        Session::flash("post-update-message", "Post with title was updated " . $inputs["title"]);

        return redirect()->route("post.index");
    }

    public function destroy(Post $post)
    {
        $this->authorize("destroy", $post);
        $post->delete();
        Session::flash("message", "Post was deleted");

        return back();
    }
}
