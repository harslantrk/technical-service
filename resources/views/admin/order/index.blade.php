@extends('admin.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sipariş
                <small>Sipariş Listesi</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/admin')}}"><i class="fa fa-dashboard"></i>Ana Sayfa</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                @if($deleg['a'] == 1)
                    <div class="col-lg-12">
                        <a href="{{URL::to('/admin/order/create')}}" class="btn btn-primary">Sipariş Ekle</a>
                    </div>
                @endif
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Siparişler</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="service_table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="col-sm-1">#</th>
                                    <th>Müşteri</th>
                                    <th>Ürün</th>
                                    <th>Adet</th>
                                    <th>Fiyat</th>
                                    <th>Açıklama</th>
                                    <th>Tarih</th>
                                    <th>İşlem</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1;?>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$order->customer->name}}</td>
                                    <td>{{$order->product->name}}</td>
                                    <td>{{$order->quantity}}</td>
                                    <td>{{$order->price}}</td>
                                    <td>{{$order->detail}}</td>
                                    <td>{{\App\Helpers\Helper::dmYHi($order->created_at)}}</td>
                                    <td class="col-sm-2">
                                        <a href="{{URL::to('admin/order/show/'.$order->id)}}" class="btn btn-primary" title="Siparişi Görüntüle"><i class="fa fa-search"></i></a>
                                        @if($deleg['u'] == 1)
                                       <a href="{{URL::to('/admin/order/edit/'.$order->id)}}" title="Siparişi Güncelle" class="button btn btn-warning"><i class="fa fa-edit"></i></a>
                                        @endif
                                        @if($deleg['d'] == 1)
                                        <a onclick="deleteApprove('/admin/order/delete/'{{$order->id}})" title="Siparişi Sil" class="button btn btn-danger"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                <?php $no++;?>
                                @endforeach
                                </tbody>
                            </table>
                            <div>
                                @if($no > 1)
                                <a id="excel" href="{{URL::to('/admin/service/AllServiceExcelExport')}}" class="btn btn-success">
                                    <i class="fa fa-file-excel-o">&nbsp; Excel Çıktısı</i></a>
                                @endif
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection