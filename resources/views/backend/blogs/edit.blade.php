@extends("backend.layout")
@section("content")
    <section class="content-header">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Edit Your Blog
                </h3>
            </div>

            <div class="box-body">
                <form action="{{route("blog.update", $blogs->id)}}" method="post" enctype="multipart/form-data">
                    @CSRF
                    @method("PUT") {{-- BUNU UPDATE EDERKEN FORMA YAZMAN GEREK --}}

                    @isset($blogs->blog_file)
                    <div class="form-group">
                        <label>Your Image</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <img width="100" src="/images/blogs/{{$blogs->blog_file}}" alt="">
                            </div>
                        </div>
                    </div>
                    @endisset

                    <div class="form-group">
                        <label>Choose New Image (MAX:2 MB) and (700x400)</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="file" name="blog_file">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Title</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="{{$blogs->blog_title}}" required type="text" name="blog_title" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="{{$blogs->blog_slug}}" type="text" name="blog_slug" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="blog_status" class="form-control">
                                    <option {{$blogs->blog_status=="1" ? "selected=''" : ""}} value="1">Active</option>
                                    <option {{$blogs->blog_status=="0" ? "selected=''" : ""}} value="0">Passive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Blog</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <textarea class="form-control" required id="editor1" name="blog_content">
                                    {{$blogs->blog_content}}
                                </textarea>
                                <script>
                                    CKEDITOR.replace("editor1");
                                </script>
                            </div>
                        </div>
                    </div>

                    <!-- BURADA YÜKLEMEDEN BİR ÖNCEKİ FOTONUN DEĞERİNİ ALIP CONTROLLERDA SİLİYORUM (BLOG) -->

                    <input type="hidden" name="old_file" value="{{$blogs->blog_file}}">

                    <div align="right" class="box-footer">
                        <button type="submit" class="btn btn-success">UPDATE</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection
@section("css")@endsection
@section("js")@endsection
