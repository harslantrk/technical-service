@extends('admin.master')
@section('content')
    @foreach($readSupports as $readSupport)
    @endforeach
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{$supports[0]->user_name.' "'.$readSupport->title.'"'}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Mailbox</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">Mesajlar</h3>
                            <div class="box-tools">
                                <a class="btn btn-box-tool"><i class="fa fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <ul class="nav nav-pills nav-stacked">
                                <li class="active">
                                    <a href="{{URL::to('admin/support')}}"><i class="fa fa-inbox"></i> Gelen Kutusu
                                        @if($reads >0)
                                            <span class="label label-primary pull-right">{{$reads}}</span>
                                        @endif
                                    </a>
                                </li>
                                <li><a href="{{URL::to('admin/support/sent')}}"><i class="fa fa-envelope-o"></i> Gönderilenler</a></li>
                                @if($deleg['d'] == 1)
                                    <li><a href="#"><i class="fa fa-trash-o"></i> Silinenler</a></li>
                                @endif
                                <li><a href="#"><i class="fa fa-star text-yellow"></i> Yıldızlılar</a></li>
                            </ul>
                        </div><!-- /.box-body -->
                    </div><!-- /. box -->
                </div><!-- /.col -->
                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-body no-padding">
                            <div class="mailbox-read-info">
                                <h3>Başlık : {{$readSupport->title}}</h3>
                                <h5>Gönderilen : {{$supports[0]->user_name}} <span class="mailbox-read-time pull-right">{{\Carbon\Carbon::parse($readSupport->created_at)->format('d M Y H:i:s')}}</span></h5>
                            </div><!-- /.mailbox-read-info -->
                            <div class="mailbox-read-message">
                                Mesaj : {!! $readSupport->detail !!}
                            </div><!-- /.mailbox-read-message -->
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <form id="myForm" role="form" action="{{URL::to('/admin/support/supportSave')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="sender_id" value="{{Auth::user()->id}}">
                                <div class="form-group">
                                    <select id="receiver_id" name="receiver_id[]" class="form-control select2" multiple="multiple" data-placeholder="Kişi Seçin" style="width: 100%;" disabled>
                                        @foreach($users as $user)
                                            @if($readSupport->receiver_id == $user->id)
                                                <option selected value="{{$user->id}}">{{$user->name}}</option>
                                                @else
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                             @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input id="title" name="title" class="form-control" value="{{$readSupport->title}}" disabled>
                                </div>
                                <div class="form-group">
                                    <textarea id="detail" name="detail" class="form-control" style="height: 300px" placeholder="Mesaj'ınızı Buraya Yazınız..."></textarea>
                                </div>
                                {{--<div class="form-group">
                                    <div class="btn btn-default btn-file">
                                        <i class="fa fa-paperclip"></i> Attachment
                                        <input type="file" name="attachment">
                                    </div>
                                    <p class="help-block">Max. 32MB</p>
                                </div>--}}
                                <div class="modal-footer">
                                    <a href="{{URL::to('admin/support')}}" type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> İptal</a>
                                    <button id="supportSaveBtn" type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Mesajı Gönder</button>
                                </div>
                            </form>
                        </div><!-- /.box-footer -->
                    </div><!-- /. box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection
@section('jscode')
    <script>
        $('#myForm').submit(function() {
            $('#receiver_id').removeAttr('disabled');
            $('#title').removeAttr('disabled');
        });
    </script>
    @endsection