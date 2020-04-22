@extends("backend.layout")
@section("content")
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Settings
                </h3>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Content</th>
                            <th>Key</th>
                            <th>Type</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                    {{-- FOREACH İLE VERİLERİMİ TABLOYA ÇEKİYORUM --}}
                    @foreach($data["adminSettings"] as $adminSettings)
                        <tr id="item-{{$adminSettings->id}}">
                            <td>{{$adminSettings->id}}</td>
                            <td class="sortable">{{$adminSettings->settings_description}}</td>
                            <td>
                                {{-- EĞER TYPE DEĞERİ FILE İSE DOSYA YOLUNA GİDİP VALUEDEKİ FOTOYU ÇEKİYOR --}}
                                @if($adminSettings->settings_type == "file")
                                    <img style="border-radius: 15px" width="100" src="/images/settings/{{$adminSettings->settings_value}}" alt="">
                                    @else
                                    {{$adminSettings->settings_value}}
                                @endif
                            </td>
                            <td>{{$adminSettings->settings_key}}</td>
                            <td>{{$adminSettings->settings_type}}</td>
                            {{-- EDIT İŞLEMİ İÇİN ROUTEA ID İLE BİRLİKTE YÖNLENDİRİYORUM --}}
                            <td width="5"><a href="{{route("settings.Edit", ["id" => $adminSettings->id])}}"><i class="fa fa-pencil-square"></i></a></td>
                            {{-- SİLME İCONU İÇİN KODLARIMI YAZDIM --}}
                            <td width="5">
                                {{-- EĞER DEĞER SİLİNEMEZ İSE VERİTABANINDA, SİLME BUTONUNU GİZLİYORUM --}}
                                @if($adminSettings->settings_delete)
                                <a href="javascript:void(0)">
                                    {{-- BURADA SİLİNECEK ID'Yİ ALIYORUM --}}
                                    <i id="@php echo $adminSettings->id @endphp" class="fa fa-trash-o"></i>
                                </a>
                                @endif
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
                        url: "{{route('settings.Sortable')}}",
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
                    location.href = "settings/delete/" + destroy_id;
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
