@extends("backend.layout")
@section("content")
    <section class="content-header">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Edit Your Page
                </h3>
            </div>

            <div class="box-body">
                <form action="{{route("page.update", $pages->id)}}" method="post" enctype="multipart/form-data">
                    @CSRF
                    @method("PUT")
                    @isset($pages->page_file)
                    <div class="form-group">
                        <label>Your Image</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <img width="100" src="/images/pages/{{$pages->page_file}}" alt="">
                            </div>
                        </div>
                    </div>
                    @endisset

                    <div class="form-group">
                        <label>Choose New Image (MAX:2 MB)</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="file" name="page_file">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Title</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="{{$pages->page_title}}" required type="text" name="page_title" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="{{$pages->page_slug}}" type="text" name="page_slug" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="page_status" class="form-control">
                                    <option {{$pages->page_status=="1" ? "selected=''" : ""}} value="1">Active</option>
                                    <option {{$pages->page_status=="0" ? "selected=''" : ""}} value="0">Passive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Page</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <textarea class="form-control" required id="editor1" name="page_content">
                                    {{$pages->page_content}}
                                </textarea>
                                <script>
                                    CKEDITOR.replace("editor1");
                                </script>
                            </div>
                        </div>
                    </div>

                    <!-- BURADA YÜKLEMEDEN BİR ÖNCEKİ FOTONUN DEĞERİNİ ALIP CONTROLLERDA SİLİYORUM (BLOG) -->

                    <input type="hidden" name="old_file" value="{{$pages->page_file}}">

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
