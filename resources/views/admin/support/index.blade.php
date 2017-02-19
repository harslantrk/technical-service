@extends('admin.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Mesajlarım
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
                                    <li><a href="{{URL::to('admin/support/trash')}}"><i class="fa fa-trash-o"></i> Silinenler</a></li>
                                @endif
                                <li><a href="#"><i class="fa fa-star text-yellow"></i> Yıldızlılar</a></li>
                            </ul>
                        </div><!-- /.box-body -->
                    </div><!-- /. box -->
                </div><!-- /.col -->
                <div class="col-md-9">
                    <div class="box box-danger" id="writeSupportDiv" style="display: none;">
                        <div class="box-header with-border">
                            <h3 class="box-title">Mesaj Yaz</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form role="form" action="{{URL::to('/admin/support/supportSave')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="sender_id" value="{{Auth::user()->id}}">
                                <div class="form-group">
                                    <select id="receiver_id" name="receiver_id[]" class="form-control select2" multiple="multiple" data-placeholder="Kişi Seçin" style="width: 100%;" onchange="aktifEt()">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input name="title" class="form-control" placeholder="Mesaj Başlığı:">
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
                                    <button onclick="cancelSupport()" type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> İptal</button>
                                    <button id="supportSaveBtn" type="submit" class="btn btn-primary" disabled><i class="fa fa-check"></i> Mesajı Gönder</button>
                                </div>
                            </form>
                        </div><!-- /.box-body -->
                    </div><!-- /. box -->

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Gelen Kutusu</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="support_table" class="table table-hover table-striped table-responsive text-center">
                                <thead>
                                <tr>
                                    <th><a id="all_trash" class="btn btn-danger" style="display: none;"><i class="fa fa-trash"></i></a><a id="all_check" class="btn btn-default" onclick="checK()">Seç</a></th>
                                    <th class="mailbox-star"><i class="fa fa-star text-yellow"></i></th>
                                    <th>Gönderen</th>
                                    <th>Konu</th>
                                    <th>Tarihi</th>
                                    <th>İŞLEM</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($supports as $support)
                                    @if($support->read == 1)
                                        <tr>
                                    @else
                                        <tr style="background-color: #f7ecb5">
                                    @endif
                                        <td><input type="checkbox"></td>
                                        <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
                                        <td class="mailbox-name"><a href="{{URL::to('admin/support/read-support/'.$support->id)}}">{{$support->user_name}}</a></td>
                                        <td class="mailbox-subject"><b>{{$support->title}}</b></td>
                                        <td class="mailbox-attachment">{{\Carbon\Carbon::parse($support->created_at)->format('d/m/Y H:i:s')}}</td>
                                        <td class="mailbox-date">
                                            <div class="mailbox-controls">
                                                <!-- Check all button -->
                                                <div class="btn-group">
                                                    @if($deleg['d'] == 1)
                                                        <a href="{{URL::to('admin/support/delete/'.$support->id)}}"  class="btn btn-danger btn-sm" title="Çöpe Gönder"><i class="fa fa-trash-o"></i></a>
                                                    @endif
                                                    <a href="{{URL::to('admin/support/reply-support/'.$support->id)}}" class="btn btn-primary btn-sm" title="Yanıtla"><i class="fa fa-reply"></i></a>
                                                </div><!-- /.btn-group -->
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.box-body -->
                    </div><!-- /. box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection
@section('jscode')
    <script>
        $(document).ready(function () {
            CKEDITOR.replace('detail');

            $('input[type="checkbox"]').iCheck({
                checkboxClass: 'icheckbox_flat-red'
            });
            $(".mailbox-star").click(function (e) {
                e.preventDefault();
                //detect type
                var $this = $(this).find("a > i");
                var fa = $this.hasClass("fa");

                if (fa) {
                    $this.toggleClass("fa-star");
                    $this.toggleClass("fa-star-o");
                }
            });
        });

        function checK() {
            var clicks = $(this).data('clicks');
            var all_trash = document.getElementById('all_trash');

            if (clicks) {
                //Uncheck all checkboxes
                $("input[type='checkbox']").iCheck("uncheck");
                all_trash.setAttribute('style','display:none');
                document.getElementById('all_check').innerHTML = 'Seç';
            } else {
                //Check all checkboxes
                $("input[type='checkbox']").iCheck("check");
                all_trash.removeAttribute('style');
                document.getElementById('all_check').innerHTML = 'İptal';
            }
            $(this).data("clicks", !clicks);
        }
        function createSupport() {
            $('#createSupport').attr('disabled','');
            $('#writeSupportDiv').removeAttr('style');
        }
        function cancelSupport() {
            $('#createSupport').removeAttr('disabled');
            $('#writeSupportDiv').attr('style','display:none');
        }
        function aktifEt() {
            var receiver_id = $('#receiver_id').val();
            if(receiver_id){
                document.getElementById('supportSaveBtn').removeAttribute('disabled');
            }else{
                document.getElementById('supportSaveBtn').setAttribute('disabled','');
            }
        }
    </script>
@endsection