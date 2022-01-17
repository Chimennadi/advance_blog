<x-admin-master>
    @section("content")
    <h1>Create</h1>
    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" aria-describedby="" placeholder="Enter title">
        </div>
        <div class="form-group">
            <label for="file">File</label>
            <input type="file" class="form-control-file" name="post_image" id="post_image" aria-describedby="">
        </div>
        <div class="form-group">
            <textarea name="body" class="form-control" id="body" cols="30" rows="10"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @stop
</x-admin-master>