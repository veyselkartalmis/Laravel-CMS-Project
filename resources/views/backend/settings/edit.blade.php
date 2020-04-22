@extends("backend.layout")
@section("content")
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Edit
                </h3>
            </div>
            <div class="box-body">
                <form action="{{route("settings.Update", ["id" => $edit->id])}}" method="post" enctype="multipart/form-data">
                    @CSRF
                    <div class="form-group">
                        <label>Descripiton</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" readonly type="text" value="{{$edit->settings_description}}" >
                            </div>
                        </div>
                    </div>

                    {{-- BURADA İSE SETTINGS TYPE'A GÖRE INPUTLARI GETİRİYORUM RESİMLE RESİM, TEXT İSE TEXT VS --}}
                    @if($edit->settings_type == "file")
                    <div class="form-group">
                        <label>Choose Image</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" required type="file" name="settings_value">
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="form-group">
                        <label>Value</label>
                        <div class="row">
                            <div class="col-xs-12">
                                @if($edit->settings_type == "text")
                                <input class="form-control" type="text" required value="{{$edit->settings_value}}" name="settings_value">
                                @endif

                                @if($edit->settings_type == "textarea")
                                <textarea class="form-control" required name="settings_value">{{$edit->settings_value}}</textarea>
                                @endif

                                @if($edit->settings_type == "file")
                                <img style="border-radius: 15px" width="150" src="/images/settings/{{$edit->settings_value}}" alt="">
                                @endif

                                @if($edit->settings_type == "ckeditor")
                                <textarea class="form-control" id="editor1" required name="settings_value">{{$edit->settings_value}}</textarea>
                                @endif

                                <script>
                                    CKEDITOR.replace("editor1");
                                </script>
                            </div>
                        </div>
                    </div>

                    {{-- BURADA YÜKLEMEDEN BİR ÖNCEKİ FOTONUN DEĞERİNİ ALIP CONTROLLERDA SİLİYORUM (SETTINGS)  --}}
                    @if($edit->settings_type == "file")
                        <input type="hidden" name="old_file" value="{{$edit->settings_value}}">
                    @endif

                    <div align="right" class="box-footer">
                        <button type="submit" class="btn btn-success">SAVE SETTINGS</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
@endsection
@section("css")@endsection
@section("js")@endsection
