@extends("backend.layout")
@section("content")
    <section class="content-header">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Write New Slider
                </h3>
            </div>

            <div class="box-body">
                <form action="{{route("slider.store")}}" method="post" enctype="multipart/form-data">
                    @CSRF
                    <div class="form-group">
                        <label>Choose Image (MAX:2 MB)</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" required type="file" name="slider_file">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Title</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="" required type="text" name="slider_title" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="" type="text" name="slider_slug" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Slider URL</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="" type="text" name="slider_url" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="slider_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Passive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Slider</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <textarea class="form-control" required id="editor1" name="slider_content">
                                </textarea>
                                <script>
                                    CKEDITOR.replace("editor1");
                                </script>
                            </div>
                        </div>
                    </div>

                    {{-- BURADA YÜKLEMEDEN BİR ÖNCEKİ FOTONUN DEĞERİNİ ALIP CONTROLLERDA SİLİYORUM (SETTINGS)  --}}
{{--                    @if($edit->settings_type == "file")--}}
{{--                        <input type="hidden" name="old_file" value="{{$edit->settings_value}}">--}}
{{--                    @endif--}}

                    <div align="right" class="box-footer">
                        <button type="submit" class="btn btn-success">ADD</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection
@section("css")@endsection
@section("js")@endsection
