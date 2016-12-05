@extends('admin.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Ürünler
    <small>Ürün Ekle</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/admin')}}"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
    <li><a href="{{URL::to('/admin/product/')}}">Ürünler</a></li>
    <li class="active">Tüm Ürünler</li>
  </ol>
</section>
<!-- Main content -->
  <section class="content">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Yeni Ürün Ekleme</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
      <!-- form start -->
      <form role="form" method="post" action="{{URL::to('/admin/product/save')}}">
        {!! csrf_field() !!}
          <div class="form-group">
            <label class="control-label">Ürün Adı</label>
            <input type="text" class="form-control" name="name">
          </div>
          <div class="form-group">
            <label class="control-label">Marka</label>
            <select name="brand_id" class="select2 form-control">
              <option selected disabled>Marka Seçiniz</option>
              @foreach($brands as $brand)
                <option value="{{$brand->id}}">{{$brand->brand}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Ürün Türü</label>
            <select name="product_type_id" class="select2 form-control">
              <option selected disabled>Ürün Türü Seçiniz</option>
              @foreach($product_types as $product_type)
                <option value="{{$product_type->id}}">{{$product_type->product_type}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Ürün Açıklaması</label>
            <textarea class="form-control" style="resize: none;" name="detail"  cols="30" rows="10"></textarea>
          </div>
        <div class="form-group">
          <label class="control-label">Ürün Stoğu</label>
          <input type="number" class="form-control" name="stock">
        </div>
        <div class="form-group">
          <label class="control-label">Ürün Geliş Fiyatı</label>
          <input type="number" class="form-control" name="in_price">
        </div>
        <div class="form-group">
          <label class="control-label">Ürün Çıkış Fiyatı</label>
          <input type="number" class="form-control" name="out_price">
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa fa-hdd-o"></i> Kaydet</button>
        <a href="{{URL::to('/admin/product/')}}" class="button btn btn-default"><i class="fa fa-undo"></i> Geri</a>
      </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection