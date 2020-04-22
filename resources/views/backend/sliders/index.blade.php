@extends("backend.layout")
@section("content")
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Sliders</h3>
                <div align="right">
                    <a href="{{route("slider.create")}}" class="btn btn-success">NEW ADD</a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Slider Image</th>
                            <th>Slider Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                    {{-- FOREACH İLE VERİLERİMİ TABLOYA ÇEKİYORUM --}}
                    @foreach($data["slider"] as $slider)
                        <tr id="item-{{$slider->id}}">
                            <td width="250" class="sortable"> <img style="border-radius: 7px" width="175" src="/images/sliders/{{$slider->slider_file}}" alt="Upload Images"> </td>
                            <td>{{$slider->slider_title}}</td>
                            {{-- EDIT İŞLEMİ İÇİN ROUTEA ID İLE BİRLİKTE YÖNLENDİRİYORUM --}}
                            <td width="5"><a href="{{route("slider.edit", $slider->id)}}"><i class="fa fa-pencil-square"></i></a></td>
                            <td width="5">
                                <a href="javascript:void(0)">
                                    {{-- BURADA SİLİNECEK ID'Yİ ALIYORUM --}}
                                    <i id="{{$slider->id}}" class="fa fa-trash-o"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        {{-- SORTABLE İŞLEMİ İÇİN YAZILAN FONKSİYON --}}
        $(function(){

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#sortable').sortable({
                revert: true,
                handle: ".sortable",
                stop: function (event, ui) {
                    var data = $(this).sortable('serialize');
                    $.ajax({
                        type: "POST",
                        data: data,
                        url: "{{route('slider.Sortable')}}",
                        success: function (msg) {
                            if (msg) {
                                alertify.success("Success");
                            } else {
                                alertify.success("Error!");
                            }
                        }
                    });
                }
            });
            $('#sortable').disableSelection();
        });
        {{-- SORTABLE İŞLEMİ İÇİN YAZILAN FONKSİYON --}}

        {{-- DELETE İŞLEMİ İÇİN YAZILAN FONKSİYON --}}
        $(".fa-trash-o").click(function () {
            destroy_id = $(this).attr("id");

            alertify.confirm("Are you sure?","This action cannot be undone!",
                function () {
                    $.ajax({
                        type: "DELETE",
                        url: "slider/" + destroy_id,
                        success: function (msg) {
                            if(msg){
                                $("#item-" + destroy_id).remove();
                                alertify.success("Deleted");
                            } else{
                                alertify.error("Canceled");
                            }
                        }
                    })
                },
                function () {
                    alertify.error("Canceled");
                }
            )
        });
        {{-- DELETE İŞLEMİ İÇİN YAZILAN FONKSİYON --}}
    </script>


@endsection
@section("css")@endsection
@section("js")@endsection
