<x-admin-master>
    @section("content")
    <h1>Edit a Post</h1>
    <form action="{{route('post.update', $post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PATCH")
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" aria-describedby="" placeholder="Enter title" value="{{$post->title}}">
        </div>
        <div class="form-group">
            <div><img height="100px" src="{{$post->post_image}}" alt=""></div>
            <label for="file">File</label>
            <input type="file" class="form-control-file" name="post_image" id="post_image" aria-describedby="">
        </div>
        <div class="form-group">
            <textarea name="body" class="form-control" id="body" cols="30" rows="10">{{$post->body}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @stop
</x-admin-master>