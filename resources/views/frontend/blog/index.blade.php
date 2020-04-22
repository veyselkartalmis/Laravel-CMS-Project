@extends("frontend.layout")
@section("title","Homepage")
@section("content")

    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Blogs</h1>

        @foreach($data["blog"] as $blog)
        <!-- Blog Post -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <a href="{{route("blog.Detail", $blog->blog_slug)}}">
                            <img class="img-fluid rounded" src="/images/blogs/{{$blog->blog_file}}" alt="">
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <h2 class="card-title">{{$blog->blog_title}}</h2>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
                        <a href="{{route("blog.Detail", $blog->blog_slug)}}" class="btn btn-primary">Read More &rarr;</a>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                Posted on {{$blog->created_at->format("d-m-Y")}}
            </div>
        </div>
        @endforeach
    </div>

@endsection
@section("css") @endsection
@section("js") @endsection
