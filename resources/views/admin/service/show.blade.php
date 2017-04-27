@extends('admin.master')

@section('content')
    <style type="text/css">
        .input-group-addon {
            min-width: 130px;
        }
        @media print{
            .non-print{
                display: none;
            }
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
                <small>Servis Güncelle</small>
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
                    <form id="showForm" method="post" action="{{URL::to('/admin/service/update/'.$service->id)}}">
                        {!! csrf_field() !!}
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{$service->id}} Numaralı Servis</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label">Müşteri Seç</label>
                                    <select name="customer_id" class="select2 form-control" style="width: 100%">
                                        <option disabled>Müşteri Seçiniz</option>
                                        @foreach($customers as $customer)
                                            @if($service->customer_id == $customer->id)
                                                <option selected value="{{$customer->id}}">{{$customer->name.' '.$customer->surname}}</option>
                                            @else
                                                <option value="{{$customer->id}}">{{$customer->name.' '.$customer->surname}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Ürün Seç</label>
                                    <select name="product_id" class="select2 form-control" style="width: 100%">
                                        <option disabled>Ürün Seçiniz</option>
                                        @foreach($products as $product)
                                            @if($service->product_id == $product->id)
                                                <option selected value="{{$product->id}}">{{$product->name}}</option>
                                            @else
                                                <option value="{{$product->id}}">{{$product->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Bildirilen Hata</label>
                                    <input value="{{$service->customer_fault}}" class="form-control" type="text" name="customer_fault" placeholder="Müşteri Tarfından Söylenilen Sorun..">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Ürün Emanetleri</label>
                                    <input value="{{$service->deposit}}" class="form-control" type="text" name="deposit" placeholder="Ürün ile Gelen Eşyalar...">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Garanti Durumu</label><br>
                                    <input type="radio" name="warranty" class="minimal" value="1" @if($service->warranty == 1) checked @endif> Var
                                    <input type="radio" name="warranty" class="minimal" value="0" @if($service->warranty == 0) checked @endif> Yok
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Yapılan İşlemler</label>
                                    <textarea class="form-control" name="process" rows="10">{{$service->process}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Müşteriye Varsa Öneri</label>
                                    <textarea class="form-control" name="process_proposal" rows="5">{{$service->process_proposal}}</textarea>
                                </div>
                            </div><!-- /.box-body -->
                        </div><!-- /. box -->
                    </form>
                </div><!-- /.col -->
            </div><!-- ./row -->
            @if($service_payments)
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
            @endif
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection
@section('jscode')
    <script>
        var a = $('#showForm >div textarea,input,select');
        for(var i=2;i<a.length;i++){
            console.log('asd');
            a[i].setAttribute('disabled','');
        }
    </script>
    @endsection