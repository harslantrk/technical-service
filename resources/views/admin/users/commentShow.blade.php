@extends('admin.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Üyeler
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
                <li><a href="/admin/users"><i class="fa fa-dashboard active"></i> Üyeler</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Yeni Üye Ekleme</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <ul class="timeline timeline-inverse">
                        <!-- timeline time label -->
                        <?php
                            $tarih = "";
                            $tarih_2 = "";
                        ?>
                        @foreach($comments as $comment)
                            <?php
                            $tarih_2 = \Carbon\Carbon::parse($comment->created_at)->format('d / m / Y');
                            ?>
                            @if($tarih_2 != $tarih)
                            <li class="time-label">
                                <span class="bg-red">
                                  {{\Carbon\Carbon::parse($comment->created_at)->format('d / m / Y')}}
                                </span>
                            </li>
                            @endif
                            <li>
                                <i class="fa fa-comments bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::parse($comment->created_at)->format('H:i:s')}}</span>
                                    <h3 class="timeline-header"><a href="#">{{$comment->user->name}}</a> {{$comment->product->name}}</h3>
                                    <div class="timeline-body">
                                       {{$comment->comment}}
                                    </div>
                                    <div class="timeline-footer">
                                        <a href="/admin/product/show/{{$comment->product_id}}" class="btn btn-primary btn-flat btn-xs">Yorumu Üründe Gör...</a>
                                    </div>
                                </div>
                            </li>
                            <?php
                                $tarih = \Carbon\Carbon::parse($comment->created_at)->format('d / m / Y');
                            ?>
                            @endforeach
                        <!-- END timeline item -->
                        <li>
                            <i class="fa fa-clock-o bg-gray"></i>
                        </li>
                    </ul>
                </div>
            </div><!-- /.box -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection