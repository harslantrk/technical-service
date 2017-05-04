@extends('admin.master')

@section('content')
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
                <small>Sipariş Ekle</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/admin')}}"><i class="fa fa-dashboard"></i>Ana Sayfa</a></li>
                <li><a href="{{URL::to('/admin/order')}}"><i class="fa fa-dashboard"></i> Siparişler</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{URL::to('/admin/order/save')}}">
                        {!! csrf_field() !!}
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Yeni Sipariş</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label">Müşteri Seç</label>
                                    <select name="customer_id" class="select2 form-control" style="width: 100%">
                                        <option selected disabled>Müşteri Seçiniz</option>
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->name.' '.$customer->surname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Ürün Seç</label>
                                    <select name="product_id" id="product_id" class="select2 form-control" style="width: 100%">
                                        <option selected disabled>Ürün Seçiniz</option>
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Adet</label>
                                    <input class="form-control" type="number" id="quantity"  name="quantity" placeholder="Sipariş Adeti..">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Açıklama</label>
                                    <textarea class="form-control" name="process_proposal" rows="5"></textarea>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <div class="pull-right">
                                    <a href="{{URL::to('/admin/order')}}" class="btn btn-default"><i class="fa fa-pencil"></i> İptal</a>
                                    <button type="submit" class="btn btn-primary" id="btnKaydet">
                                        <i class="fa fa-envelope-o"></i> Kaydet</button>
                                </div>
                            </div><!-- /.box-footer -->
                        </div><!-- /. box -->
                    </form>
                </div><!-- /.col -->
            </div><!-- ./row -->
            <div class="row" id="control" style="display: none;">

            </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection
@section('jscode')
    <script type="text/javascript">
        var product_id = document.getElementById('product_id');
            $('#quantity').keyup(function () {
                var quantity = document.getElementById('quantity').value;
                console.log(product_id.selectedIndex+'-'+quantity);

                $.ajax({
                    url: '/admin/order/OrderControl',
                    type: 'POST',
                    beforeSend: function (xhr) {
                        var token = $('meta[name="csrf_token"]').attr('content');

                        if (token) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    },
                    cache: false,
                    data: {quantity: quantity,product_id:product_id.selectedIndex},
                    success: function(data){
                        document.getElementById('control').removeAttribute('style');
                        document.getElementById('control').innerHTML=data;
                        //Buton değiştirme İşlemleri
                        var nothingCount = $('.nothing').length;
                        var btnKaydet = document.getElementById('btnKaydet');
                        if(nothingCount > 0){
                            console.log(nothingCount);
                            btnKaydet.setAttribute('disabled','');
                            btnKaydet.innerText = 'Eksik Ürün Adeti Bulunmakta.';
                        }else{
                            btnKaydet.removeAttribute('disabled');
                            btnKaydet.innerText = 'Kaydet';
                        }
                        //İşlemler Bitiş
                    },
                    error: function(jqXHR, textStatus, err){}
                });
        });
    </script>
@endsection