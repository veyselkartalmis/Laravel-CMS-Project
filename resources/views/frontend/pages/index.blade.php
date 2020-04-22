@extends("frontend.layout")
@section("title","Homepage")
@section("content")

    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Pages</h1>

        @foreach($data["page"] as $page)
        <!-- Blog Post -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <a href="{{route("page.Detail", $page->page_slug)}}">
                            <img class="img-fluid rounded" src="/images/pages/{{$page->page_file}}" alt="">
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <h2 class="card-title">{{$page->page_title}}</h2>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
                        <a href="{{route("page.Detail", $page->page_slug)}}" class="btn btn-primary">Read More &rarr;</a>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                Posted on {{$page->created_at->format("d-m-Y")}}
            </div>
        </div>
        @endforeach
    </div>

@endsection
@section("css") @endsection
@section("js") @endsection
