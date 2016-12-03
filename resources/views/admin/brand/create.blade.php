@extends('admin.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Marka
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
                <li><a href="/admin/brand"><i class="fa fa-dashboard active"></i> Marka</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Yeni Marka Ekleme</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{URL::to('/admin/brand/save')}}">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label">Marka</label>
                            <input type="text" class="form-control" name="brand">
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-hdd-o"></i> Kaydet</button>
                        <a href="/admin/brand" class="button btn btn-default"><i class="fa fa-undo"></i> Geri</a>
                    </div>
                </form>
            </div><!-- /.box -->

        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
@endsection