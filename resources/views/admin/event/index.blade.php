@extends('admin.master')

@section('content')
    <?php setlocale(LC_ALL,'TR');?>
    @if($deleg['u'] == 0 && $deleg['d'] == 0 && $deleg['a'] == 0)
        <script type="text/javascript">
            alert('Sadece Görüntüleme Yetkisine Sahipsiniz !');
        </script>
    @endif
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tüm Randevularım
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/admin')}}"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
                <li class="active">Takvim</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div>
                        @if($deleg['a'] == 1)
                            <a href="#" id="createCalendar" class="btn btn-block btn-primary btn-lg"  data-toggle="modal" data-target="#modalYeniRandevu" style="margin-bottom:20px;">Yeni Randevu Ekle</a>
                        @endif
                    </div>
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Randevularım</h3>
                            <div class="box-tools">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                @foreach($calendars as $calendar)
                                    @if($deleg['u'] == 1)
                                        <li style="background-color:#F7F7F7;"><b>{{\Carbon\Carbon::parse($calendar->start_time)->formatLocalized('%d %B %Y')}}</b></li>
                                        <li style="background-color:#FFF;"><a href="#" id="{{$calendar->id}}" class="calendarModal"  data-toggle="modal" data-target="#modalUpdateCalendar">{{\Carbon\Carbon::parse($calendar->start_time)->format('H:i').' '.$calendar->title}}</a></li>
                                        @else
                                        <li style="background-color:#F7F7F7;"><b>{{\Carbon\Carbon::parse($calendar->start_time)->formatLocalized('%d %B %Y')}}</b></li>
                                        <li style="background-color:#FFF;"><span>{{\Carbon\Carbon::parse($calendar->start_time)->format('H:i').' '.$calendar->title}}</span></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div><!-- /.box-body -->
                    </div><!-- /. box -->
                </div><!-- /.col -->
                <div class="col-md-9">
                    <div class="box box-primary">
                        <!-- THE CALENDAR -->
                        <div id="calendar"></div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <!-- Randevu Ekleme Modeli -->
    <div class="modal fade" id="modalYeniRandevu" tabindex="-1" role="dialog">

    </div>
    <!-- /.modal -->
    <!-- Randevu Güncelleme Modeli -->
    <div class="modal fade" id="modalUpdateCalendar" tabindex="-1" role="dialog">

    </div>
    <!-- /.modal -->
@endsection
@section('jscode')
    <script>
        $(document).ready(function() {
            var calendar_url = '{{url('/admin/event')}}';
            if(calendar_url){
                var a =$('#calendar div > div');
                a[0].removeAttribute('style');
                //console.log(a[0]);
            }
            var base_url = '{{ url('/') }}';
            $('#calendar').fullCalendar({
                weekends: true,
                lang:'tr',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: false,
                eventLimit: true, // allow "more" link when too many events
                events: {
                    url: base_url + '/admin/event/api',
                    error: function() {
                        alert("Gelen Json Verisi Bulunamadı.");
                    }
                }
            });
        });
        $('#createCalendar').click(function () {
            var deger = 'a';
            /*console.log($(this).attr('name'));*/
            $.ajax({
                url: '/admin/event/createCalendarModalShow',
                type: 'POST',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf_token"]').attr('content');

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                cache: false,
                data: {deger: deger},
                success: function(data){
                    document.getElementById('modalYeniRandevu').innerHTML=data;
                },
                error: function(jqXHR, textStatus, err){}
            });
        });
        $('.calendarModal').click(function () {
            var event_id = $(this).attr('id');
            console.log(event_id);
            $.ajax({
                url: '/admin/event/editModal',
                type: 'POST',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf_token"]').attr('content');

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                cache: false,
                data: {event_id: event_id},
                success: function(data){
                    document.getElementById('modalUpdateCalendar').innerHTML=data;
                },
                error: function(jqXHR, textStatus, err){}
            });
        });
        function titleBtn() {
            console.log('asd');
            var title = $('#title').val().trim();
            if(title.length >= 5){
                document.getElementById('randevuSaveBtn').removeAttribute('disabled');
            }
        }
    </script>
@endsection