@extends("backend.layout")
@section("content")
    <section class="content-header">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Add New User
                </h3>
            </div>

            <div class="box-body">
                <form action="{{route("user.store")}}" method="post" enctype="multipart/form-data">
                    @CSRF
                    <div class="form-group">
                        <label>Choose Image (MAX:2 MB)</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" required type="file" name="user_file">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Name Surname</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="" required type="text" name="name" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Username (E-mail)</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="" type="email" name="email" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="" type="password" name="password" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="user_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Passive</option>
                                </select>
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
