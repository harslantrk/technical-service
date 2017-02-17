@extends('admin.master')
@section('content')
    @foreach($readSupports as $readSupport)
    @endforeach
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Read Mail
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
                    @if($deleg['a'] == 1)
                        <button id="createSupport" onclick="createSupport()" class="btn btn-primary btn-block margin-bottom" data-toggle="modal" data-target="#modalNewSupport">Yeni Mesaj</button>
                    @endif
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
                        <div class="box-header with-border">
                            <h3 class="box-title">{{$readSupport->id}} Numaralı Mesaj Görüntüleniyor.</h3>
                            <div class="box-tools pull-right">
                                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="mailbox-read-info">
                                <h3>{{$readSupport->title}}</h3>
                                <h5>{{$supports[0]->user_name}} <span class="mailbox-read-time pull-right">{{\Carbon\Carbon::parse($readSupport->created_at)->format('d M Y H:i:s')}}</span></h5>
                            </div><!-- /.mailbox-read-info -->
                            <div class="mailbox-read-message">
                               {!! $readSupport->detail !!}
                            </div><!-- /.mailbox-read-message -->
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="pull-right">
                                <button class="btn btn-danger"><i class="fa fa-trash-o"></i> Sil</button>
                                <button class="btn btn-primary"><i class="fa fa-reply"></i> Yanıtla</button>
                            </div>
                            <a href="{{URL::to('admin/support')}}" class="btn btn-default"><i class="fa fa-close"></i>Geri Dön</a>
                        </div><!-- /.box-footer -->
                    </div><!-- /. box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection