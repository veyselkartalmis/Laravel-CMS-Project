@extends("frontend.layout")
@section("title","Page")
@section("content")

    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">{{$page->page_title}}</h1>

        <div class="row">

            <!-- Post Content Column -->
            <div class="col-lg-8">

                <!-- Preview Image -->
                <img class="img-fluid rounded" src="/images/pages/{{$page->page_file}}" alt="">

                <hr>
                <!-- Date/Time -->
                <p>Posted on {{$page->created_at->format("d-m-Y")}}</p>
                <hr>

                <!-- Post Content -->
                <p>{!! $page->page_content !!}</p>

            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">
                <!-- Side Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Last Blogs</h5>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($lastPages as $list )
                                <a href="{{route("page.Detail", $list->page_slug)}}">
                                    <li class="list-group-item">{{$list->page_title}}</li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section("css") @endsection
@section("js") @endsection
