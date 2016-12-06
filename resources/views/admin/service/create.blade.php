@extends('admin.master')

@section('content')
<style type="text/css">
  .input-group-addon {
    min-width: 130px;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- ALERT -->
  @if (Session::has('flash_notification.message'))
    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{ Session::get('flash_notification.message') }}
    </div>
  @endif
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    TEKNİK SERVİS
    <small>Servis Ekle</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/admin')}}"><i class="fa fa-dashboard"></i>Ana Sayfa</a></li>
    <li><a href="{{URL::to('/admin/service')}}"><i class="fa fa-dashboard"></i> Servisler</a></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
        <div class="row">
            <div class="col-md-12">
            <form method="post" action="/admin/service/save">
              {!! csrf_field() !!}
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Yeni Servis</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="input-group form-group">
                    <div class="input-group-addon">
                      Müşteri Seç
                    </div>
                   <select name="customer_id" class="select2 form-control" style="width: 100%">
                     <option selected disabled>Müşteri Seçiniz</option>
                     @foreach($customers as $customer)
                       <option value="{{$customer->id}}">{{$customer->name}}</option>
                     @endforeach
                   </select>
                  </div>
                  <div class="input-group form-group">
                    <div class="input-group-addon">
                      Ürün Seç
                    </div>
                    <select name="product_id" class="select2 form-control" style="width: 100%">
                      <option selected disabled>Ürün Seçiniz</option>
                      @foreach($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="input-group form-group">
                    <div class="input-group-addon">
                      Bildirilen Hata
                    </div>
                   <input class="form-control" type="text" name="customer_fault" placeholder="Müşteri Tarfından Söylenilen Sorun..">
                  </div>
                  <div class="input-group form-group">
                    <div class="input-group-addon">
                      Ürün Emanetleri
                    </div>
                   <input class="form-control" type="text" name="deposit" placeholder="Ürün ile Gelen Eşyalar...">
                  </div>
                  <div class="input-group form-group">
                    <div class="input-group-addon">
                      Garanti
                    </div>
                    <input type="radio" name="warranty" class="minimal" value="1"> Var
                    <input type="radio" name="warranty" class="minimal" value="0"> Yok
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <div class="pull-right">
                    <a href="/admin/service" class="btn btn-default"><i class="fa fa-pencil"></i> İptal</a>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Kaydet</button>
                  </div>
                </div><!-- /.box-footer -->

              </div><!-- /. box -->
              </form>
            </div><!-- /.col -->
    </div><!-- ./row -->  
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection