@extends('admin.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    TEKNİK SERVİS
    <small>Teknik Servis Listesi</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
    <li><a href="/admin/service"><i class="fa fa-dashboard active"></i> Teknik Servis</a></li>
  </ol>
</section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
          @if($deleg['a']==1)
          <div class="col-lg-12">
				<a href="/admin/service/create" class="button btn btn-primary">Servis Ekle</a>
			</div>
          @endif
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Teknik Servisler</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="service_table" class="table table-bordered table-striped">
                    <thead>
                      <tr class="bg-red-gradient">
                      	<th class="col-sm-1">#</th>
                      	<th>Müşteri</th>
                      	<th>Ürün</th>
                      	<th>Müşteri Problemi</th>
                        <th>Garanti</th>
                      	<th>Geliş Tarihi</th>
                        <th>İşlem</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;?>
                        @foreach($services as $service)
                            @if($service->process)
                                <tr class="bg-aqua-gradient text-bold">
                                    @else
                                <tr class="bg-yellow-gradient text-bold">
                            @endif
                            <td>{{$no}}</td>
                            <td>{{$service->customer->name}}</td>
                            <td>{{$service->product->name}}</td>
                            <td>{{$service->customer_fault}}</td>
                            <td>@if($service->warranty == 1) Var @else Yok @endif</td>
                            <td>{{\Carbon\Carbon::parse($service->created_at)->format('d/m/Y H:i:s')}}</td>
                            <td>
                                @if($deleg['u']==1)<a href="/admin/service/edit/{{$service->id}}" title="Servisi Güncelle" class="button btn btn-success"><i class="fa fa-edit"></i></a>@endif
                                @if($deleg['d']==1)<a onclick="deleteApprove('/admin/service/delete/{{$service->id}}')" title="Servisi Sil" class="button btn btn-danger"><i class="fa fa-trash"></i></a>@endif
                                @if($service->process)
                                  <a onclick="serviceClose('/admin/service/serviceClose/{{$service->id}}')" title="Servisi Kapat !" class="button btn btn-default"><i class="fa fa-close"></i></a>
                                  <a href="{{URL::to('/admin/service/paymentModalView/'.$service->id)}}" title="Ücret Girişi !" class="button btn btn-default try"><i class="fa fa-try"></i></a>
                                @endif
                            </td>
                            </tr>
                          <?php $no++;?>
                        @endforeach
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection