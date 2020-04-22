@extends("backend.layout")
@section("content")
    <section class="content-header">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Edit User
                </h3>
            </div>

            <div class="box-body">
                <form action="{{route("user.update", $users->id)}}" method="post" enctype="multipart/form-data">
                    @CSRF
                    @method("PUT") {{-- BUNU UPDATE EDERKEN FORMA YAZMAN GEREK --}}

                    @isset($users->user_file)
                    <div class="form-group">
                        <label>Your Image</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <img width="100" src="/images/users/{{$users->user_file}}" alt="">
                            </div>
                        </div>
                    </div>
                    @endisset

                    <div class="form-group">
                        <label>Choose New Image (MAX:2 MB)</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" type="file" name="user_file">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Name Surname</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="{{$users->name}}" required type="text" name="name">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="{{$users->email}}" type="email" name="email" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <input class="form-control" value="" type="password" name="password" >
                                <small>Don't write if you don't want to change the password.</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <div class="row">
                            <div class="col-xs-12">
                                <select name="user_status" class="form-control">
                                    <option {{$users->user_status=="1" ? "selected=''" : ""}} value="1">Active</option>
                                    <option {{$users->user_status=="0" ? "selected=''" : ""}} value="0">Passive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- BURADA YÜKLEMEDEN BİR ÖNCEKİ FOTONUN DEĞERİNİ ALIP CONTROLLERDA SİLİYORUM (BLOG) -->
                    <input type="hidden" name="old_file" value="{{$users->user_file}}">

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
