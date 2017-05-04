@extends('admin.master')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @if($messaj = \Illuminate\Support\Facades\Session::get('success'))
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{$messaj}}
      </div>
    @elseif($mesaj = \Illuminate\Support\Facades\Session::get('error'))
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{$mesaj}}
      </div>
    @endif
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
          <div class="pull-right">
            <a href="#" id="new_join" class="btn btn-danger" data-toggle="modal" data-target="#modalNewJoin"><i class="fa fa-plus"></i> Bileşen Ekle</a>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <!-- form start -->
          <form role="form" method="post" action="{{URL::to('/admin/product/update/'.$product->id)}}">
            {!! csrf_field() !!}
            <div class="form-group">
              <label class="control-label">Ürün Adı</label>
              <input type="text" class="form-control" name="name" value="{{$product->name}}">
            </div>
            <div class="form-group">
              <label class="control-label">Marka</label>
              <select name="brand_id" class="select2 form-control" style="width: 100%;">
                <option disabled>Marka Seçiniz</option>
                @foreach($brands as $brand)
                  @if($product->brand_id == $brand->id)
                    <option selected value="{{$brand->id}}">{{$brand->brand}}</option>
                    @else
                    <option value="{{$brand->id}}">{{$brand->brand}}</option>
                  @endif
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Ürün Türü</label>
              <select name="product_type_id" class="select2 form-control" style="width: 100%;">
                <option disabled>Ürün Türü Seçiniz</option>
                @foreach($product_types as $product_type)
                  @if($product->product_type_id == $product_type->id)
                  <option selected value="{{$product_type->id}}">{{$product_type->product_type}}</option>
                  @else
                    <option value="{{$product_type->id}}">{{$product_type->product_type}}</option>
                  @endif
                    @endforeach
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Ürün Açıklaması</label>
              <textarea class="form-control" style="resize: none;" name="detail"  cols="30" rows="10">{{$product->detail}}</textarea>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label">Ürün Stoğu</label>
                <input type="number" class="form-control" name="stock" value="{{$product->stock}}">
              </div>
              <div class="form-group">
                <label class="control-label">Ürün Geliş Fiyatı</label>
                <input type="number" class="form-control" name="in_price" value="{{$product->in_price}}">
              </div>
              <div class="form-group">
                <label class="control-label">Ürün Çıkış Fiyatı</label>
                <input type="number" class="form-control" name="out_price" value="{{$product->out_price}}">
              </div>
              <button type="submit" class="btn btn-primary"><i class="fa fa-hdd-o"></i> Güncelle</button>
              <a href="{{URL::to('/admin/product/')}}" class="button btn btn-default"><i class="fa fa-undo"></i> Geri</a>
            </div>
          </form>

          <form class="form-horizontal" action="{{URL::to('/admin/product/ImagePostSave')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="col-sm-3 col-xs-6">
              <div class="form-group">
                <input class="btn" type="file" name="image" id="image">
                <input type="hidden" name="id" value="{{$product->id}}">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success">Resim Yükle</button>
              </div>
            </div>
          </form>
          <div class="col-sm-3 col-xs-6">
            <label class="control-label">Ürün Resmi</label>
            @if($product->image)
              <img class="img-responsive img-bordered" src="{{URL::to($product->image)}}" alt="User profile picture">
            @endif
          </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
      <div class="row">
        <div class="col-sm-6">
          @if($product_joins)
            <div class="box box-danger">
              <div class="box-body">
                <div class="col-xs-12 table-responsive">
                  <table class="table table-striped text-center">
                    <thead>
                    <tr>
                      <th>Ekli Ürün</th>
                      <th>Adet</th>
                      <th class="col-sm-1">İşlem</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product_joins as $product_join)
                      <tr>
                        <td>{{$product_join->name}}</td>
                        <td>{{$product_join->quantity}}</td>
                        <td>
                          <a onclick="deleteApprove('/admin/product/ProductJoinDelete/{{$product_join->id}}')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div><!-- /.col -->
              </div>
            </div>
          @endif
        </div>
      </div>
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <!-- Ürüne Bileşen Ekleme Modeli -->
  <div class="modal fade" id="modalNewJoin" tabindex="-1" role="dialog">

  </div>
  <input type="hidden" id="product_id" value="{{$product->id}}">
  <!-- /.modal -->
@endsection
@section('jscode')
  <script>
      $('#new_join').click(function () {
          var deger = 'a';
          var product_id = document.getElementById('product_id').value;
          $.ajax({
              url: '/admin/product/ProductJoin',
              type: 'POST',
              beforeSend: function (xhr) {
                  var token = $('meta[name="csrf_token"]').attr('content');

                  if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  }
              },
              cache: false,
              data: {deger: deger,product_id:product_id},
              success: function(data){
                  document.getElementById('modalNewJoin').innerHTML=data;
                  $('.select2').select2();
              },
              error: function(jqXHR, textStatus, err){}
          });
      });
  </script>
@endsection