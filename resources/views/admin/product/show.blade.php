@extends('admin.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{$products->name}} Ürünü Görüntüleniyor
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
                    <form role="form" method="post" id="kapat" action="{{URL::to('/admin/product/update/')}}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="control-label">Ürün Adı</label>
                            <input type="text" class="form-control" name="name" value="{{$products->name}}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Marka</label>
                            <select name="brand_id" class="select2 form-control" style="width: 100%;">
                                <option disabled>Marka Seçiniz</option>
                                @foreach($brands as $brand)
                                    @if($products->id == $brand->id)
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
                                    @if($products->id == $product_type->id)
                                        <option selected value="{{$product_type->id}}">{{$product_type->product_type}}</option>
                                    @else
                                        <option value="{{$product_type->id}}">{{$product_type->product_type}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Ürün Açıklaması</label>
                            <textarea class="form-control" style="resize: none;" name="detail"  cols="30" rows="10">{{$products->detail}}</textarea>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Ürün Stoğu</label>
                                <input type="number" class="form-control" name="stock" value="{{$products->stock}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Ürün Geliş Fiyatı</label>
                                <input type="number" class="form-control" name="in_price" value="{{$products->in_price}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Ürün Çıkış Fiyatı</label>
                                <input type="number" class="form-control" name="out_price" value="{{$products->out_price}}">
                            </div>
                            <a href="{{URL::to('/admin/product/')}}" class="button btn btn-default"><i class="fa fa-undo"></i> Geri</a>
                        </div>
                    </form>
                    <div class="col-sm-3 col-xs-6">
                        <label class="control-label">Ürün Resmi</label>
                        @if($products->image)
                            <img style="margin: 0px;" class="profile-user-img img-responsive" src="{{URL::to($products->image)}}" alt="User profile picture">
                        @endif
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <script type="text/javascript">
        var a = $('#kapat >div textarea,input,select');
        for(var i=2;i<a.length;i++){
            console.log('asd');
            a[i].setAttribute('disabled','');
        }
    </script>
@endsection