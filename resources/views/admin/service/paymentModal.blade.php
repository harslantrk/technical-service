@extends('admin.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                TEKNİK SERVİS
                <small>Servis Ücreti Ekle</small>
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
                    <form method="post" action="{{URL::to('/admin/service/AddPayment/'.$service->id)}}">
                        {!! csrf_field() !!}
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{$service->id}} Numaralı Servis</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="input-group form-group">
                                    <div class="input-group-addon">
                                        Ürünler
                                    </div>
                                    <select onchange="degis(this)" id="product_id" name="product_id" class="select2 form-control" style="width: 100%">
                                        <option selected disabled>Ürün Seç</option>
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}" id="{{$product->out_price}}" data-id="{{$product->stock}}">{{$product->name}}</option>
                                            @endforeach
                                    </select>
                                    <input type="hidden" id="stock">
                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-addon">
                                        Adet
                                    </div>
                                    <input class="form-control" type="number" id="quantity"  name="quantity" placeholder="Ürün Adeti..">
                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-addon">
                                        Birim Fiyat
                                    </div>
                                    <input class="form-control" type="number" id="unit_price" name="unit_price" placeholder="Ürün Fiyatı..." readonly>
                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-addon">
                                        KDV % 18
                                    </div>
                                    <input class="form-control" type="number" id="kdv" name="kdv" placeholder="Toplam KDV..." readonly>
                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-addon">
                                        Toplam
                                    </div>
                                    <input class="form-control" type="number" id="total" name="total" placeholder="Toplam Fiyat" readonly>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <div class="pull-right">
                                    <button type="submit" id="ekle" class="btn btn-success">Ekle</button>
                                </div>
                            </div><!-- /.box-footer -->
                        </div><!-- /. box -->
                    </form>
                </div><!-- /.col -->
            </div><!-- ./row -->
            <div class="box box-danger">
                <div class="box-body">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped text-center">
                                <thead>
                                <tr>
                                    <th>Ürün</th>
                                    <th>Adet</th>
                                    <th>Birim Fiyat</th>
                                    <th>KDV % 18</th>
                                    <th>Toplam</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $toplam=0;?>
                                @foreach($service_payments as $service_payment)
                                <tr>
                                    <td>{{$service_payment->product->name}}</td>
                                    <td>{{$service_payment->quantity}}</td>
                                    <td>{{$service_payment->product->out_price}}</td>
                                    <td>{{$service_payment->kdv}}</td>
                                    <td>{{$service_payment->total}}</td>
                                </tr>
                                    <?php $toplam += $service_payment->total;?>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr class="text-bold text-red">
                                    <td>Genel Toplam</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{$toplam}}</td>
                                </tr>
                                </tfoot>
                            </table>
                            <a href="{{URL::to('/admin/service/edit/'.$service->id)}}" class="btn btn-default"><i class="fa fa-undo"></i> Servise Git</a>
                        </div><!-- /.col -->
                </div>
            </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <script type="text/javascript">
        $(document).ready(function () {
            document.getElementById('ekle').setAttribute('disabled','');
        });
        function degis(s) {
            document.getElementById('unit_price').value = s[s.selectedIndex].id;
            document.getElementById('quantity').value = '';
            document.getElementById('kdv').value= '';
            document.getElementById('total').value = '';
            document.getElementById('ekle').setAttribute('disabled','');
            var stock_Varmi = s[s.selectedIndex].getAttribute('data-id');
            document.getElementById('stock').value = stock_Varmi;
            console.log(s[s.selectedIndex].id);
        }
        $('#quantity').keyup(function () {
            var quantity = document.getElementById('quantity').value;
            var kdv = document.getElementById('kdv');
            var total = document.getElementById('total');
            var unit_price =document.getElementById('unit_price').value;
            var stock =document.getElementById('stock').value;
            document.getElementById('ekle').removeAttribute('disabled');

            if(quantity>stock){
                document.getElementById('quantity').value = stock;
                quantity = stock;
                kdv.value = (quantity * unit_price) * 18/100;
                total.value = ((quantity * unit_price) + Number(kdv.value)) ;
                console.log(quantity);
            }else{
                kdv.value = (quantity * unit_price) * 18/100;
                total.value = ((quantity * unit_price) + Number(kdv.value)) ;
                console.log('q');
            }

        });
    </script>
@endsection