@extends('admin.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Panel
    <small>Kontrol paneli</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin/"><i class="fa fa-dashboard active"></i> Anasayfa </a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{$brand}}</h3>
          <p>Kayıtlı Marka</p>
        </div>
        <div class="icon">
          <i class="ion ion-medkit"></i>
        </div>
        <a href="{{URL::to('/admin/brand')}}" class="small-box-footer">Tüm Markalar <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{$customer}}</h3>
          <p>Adet Müşteri</p>
        </div>
        <div class="icon">
          <i class="ion ion-person"></i>
        </div>
        <a href="{{URL::to('/admin/customers')}}" class="small-box-footer">Tüm Müşteriler <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$product}}</h3>
          <p>Adet Ürün</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="{{URL::to('/admin/product')}}" class="small-box-footer">Tüm Ürünler <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{$service}}</h3>
          <p>Adet Servis Girişi</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="{{URL::to('/admin/service')}}" class="small-box-footer">Tüm Teknik Servis Girişleri <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
  </div><!-- /.row -->

  <div class="row">
    <div class="col-sm-6">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Son Eklenen 5 Servis</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
              <tr>
                <th>Servis No</th>
                <th>Müşteri</th>
                <th>Ürün</th>
                <th>Tarih</th>
              </tr>
              </thead>
              <tbody>
              @foreach($five_services as $five_service)
              <tr>
                <td>{{$five_service->id}}</td>
                <td>{{$five_service->customer->name}}</td>
                <td>{{$five_service->product->name}}</td>
                <td>{{\Carbon\Carbon::parse($five_service->created_at)->format('d/m/Y')}}</td>
              </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- /.table-responsive -->
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
    <div class="col-sm-6">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Son Eklenen 5 Müşteri</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
              <tr>
                <th>Ad - Soyad</th>
                <th>Telefon</th>
                <th>Tarih</th>
                <th>Adres</th>
              </tr>
              </thead>
              <tbody>
              @foreach($five_customers as $five_customer)
              <tr>
                <td>{{$five_customer->name}}</td>
                <td>{{$five_customer->gsm}}</td>
                <td>{{\Carbon\Carbon::parse($five_customer->created_at)->format('d/m/Y')}}</td>
                <td>{{$five_customer->adres}}</td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div><!-- /.table-responsive -->
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
  </div>
  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <section class="col-lg-7 connectedSortable">
      <!-- TO DO List -->
      <div class="box box-primary">
        <div class="box-header">
          <i class="ion ion-clipboard"></i>
          <h3 class="box-title">Duyurular</h3>
          <div class="box-tools pull-right">
            <ul class="pagination pagination-sm inline">
              <li><a href="#">&laquo;</a></li>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">&raquo;</a></li>
            </ul>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <ul class="todo-list">
            <li>
              <!-- drag handle -->
              <span class="handle">
                <i class="fa fa-ellipsis-v"></i>
                <i class="fa fa-ellipsis-v"></i>
              </span>
              <!-- checkbox -->
              <input type="checkbox" value="" name="">
              <!-- todo text -->
              <span class="text">Design a nice theme</span>
              <!-- Emphasis label -->
              <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
              <!-- General tools such as edit or delete-->
              <div class="tools">
                <i class="fa fa-edit"></i>
                <i class="fa fa-trash-o"></i>
              </div>
            </li>
            <li>
              <span class="handle">
                <i class="fa fa-ellipsis-v"></i>
                <i class="fa fa-ellipsis-v"></i>
              </span>
              <input type="checkbox" value="" name="">
              <span class="text">Make the theme responsive</span>
              <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
              <div class="tools">
                <i class="fa fa-edit"></i>
                <i class="fa fa-trash-o"></i>
              </div>
            </li>
            <li>
              <span class="handle">
                <i class="fa fa-ellipsis-v"></i>
                <i class="fa fa-ellipsis-v"></i>
              </span>
              <input type="checkbox" value="" name="">
              <span class="text">Let theme shine like a star</span>
              <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
              <div class="tools">
                <i class="fa fa-edit"></i>
                <i class="fa fa-trash-o"></i>
              </div>
            </li>
            <li>
              <span class="handle">
                <i class="fa fa-ellipsis-v"></i>
                <i class="fa fa-ellipsis-v"></i>
              </span>
              <input type="checkbox" value="" name="">
              <span class="text">Let theme shine like a star</span>
              <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
              <div class="tools">
                <i class="fa fa-edit"></i>
                <i class="fa fa-trash-o"></i>
              </div>
            </li>
            <li>
              <span class="handle">
                <i class="fa fa-ellipsis-v"></i>
                <i class="fa fa-ellipsis-v"></i>
              </span>
              <input type="checkbox" value="" name="">
              <span class="text">Check your messages and notifications</span>
              <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
              <div class="tools">
                <i class="fa fa-edit"></i>
                <i class="fa fa-trash-o"></i>
              </div>
            </li>
            <li>
              <span class="handle">
                <i class="fa fa-ellipsis-v"></i>
                <i class="fa fa-ellipsis-v"></i>
              </span>
              <input type="checkbox" value="" name="">
              <span class="text">Let theme shine like a star</span>
              <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
              <div class="tools">
                <i class="fa fa-edit"></i>
                <i class="fa fa-trash-o"></i>
              </div>
            </li>
          </ul>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix no-border">
          <button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Duyuru Ekle</button>
        </div>
      </div><!-- /.box -->
    </section><!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-5 connectedSortable">
      <!-- Calendar -->
      <div class="box box-solid bg-green-gradient">
        <div class="box-header">
          <i class="fa fa-calendar"></i>
          <h3 class="box-title">Takvim</h3>
          <!-- tools box -->
          <div class="pull-right box-tools">
            <!-- button with a dropdown -->
            <div class="btn-group">
              <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
              <ul class="dropdown-menu pull-right" role="menu">
                <li><a href="#">Olay Ekle</a></li>
                <li><a href="#">Olay Sil</a></li>
                <li class="divider"></li>
                <li><a href="#">Takvimi Görüntüle</a></li>
              </ul>
            </div>
            <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
          </div><!-- /. tools -->
        </div><!-- /.box-header -->
        <div class="box-body no-padding">
          <!--The calendar -->
          <div id="calendar" style="width: 100%"></div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </section><!-- right col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection
