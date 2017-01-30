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
          <h3>{{$products->count()}}</h3>
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
    <section class="col-md-6 connectedSortable">
      <!-- TO DO List -->
      <div class="box box-primary">
        <div class="box-header">
          <i class="ion ion-clipboard"></i>
          <h3 class="box-title">Yapılan Yorumlar</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="product_table" class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
              <td>#</td>
              <td>Ürün Adı</td>
              <td>Yorumu Yapan</td>
              <td>Yorum</td>
              <td>Son Güncelleme</td>
              <td>İşlemler</td>
            </tr>
            </thead>
            <tbody>
            <?php $sira = 1;?>
            @foreach($comments as $comment)
              <tr>
                <th>{{$sira}}</th>
                  @if($comment->status == 1)
                  <th><a href="/admin/product/show/{{$comment->product_id}}">{{$comment->product->name}}</a></th>
                  @else
                  <th>{{$comment->product->name}}</th>
                  @endif
                <th>{{$comment->user->name}}</th>
                <th>{{$comment->comment}}</th>
                <th>{{\Carbon\Carbon::parse($comment->updated_at)->format('d/m/Y H:i')}}</th>
                <th>
                  @if($comment->status == 0)
                  <a title="Onayla" href="/admin/product/commentCheck/{{$comment->id}}" class="btn btn-success btn-xs"><i class="fa fa-check"></i></a>
                  @else
                  <a title="Yorumu Kaldır" href="/admin/product/commentUnCheck/{{$comment->id}}" class="btn btn-danger btn-xs"><i class="fa fa-close"></i></a>
                  @endif
                </th>
              </tr>
              <?php $sira++;?>
            @endforeach
            <!-- Modal -->
            </tbody>
            <!-- Trigger the modal with a button -->
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </section><!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-md-6 connectedSortable">
      <!-- Calendar -->
      <div class="box box-danger">
        <div class="box-header">
          <i class="fa fa-book"></i>
          <h3 class="box-title">Ürünler</h3>
          <!-- tools box -->
        </div><!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered table-striped">
            <thead>
            <tr>
              <td>#</td>
              <td>Ürün Adı</td>
              <td>Marka</td>
              <td>Stok</td>
              <td>Çıkış Fiyatı</td>
              <td>İşlemler</td>
            </tr>
            </thead>
            <tbody>
            <?php $sira = 1;?>
            @foreach($products as $product)
              @if($sira<6)
                <tr>
                  <th>{{$sira}}</th>
                  <th>{{$product->name}}</th>
                  <th>{{$product->brand->brand}}</th>
                  <th>{{$product->stock}}</th>
                  <th>{{$product->out_price}}</th>
                  <th>
                    <a title="Görüntüle" href="/admin/product/show/{{$product->id}}" class="btn btn-primary btn-xs"><i class="fa fa-search"></i></a>
                  </th>
                </tr>
                @endif
              <?php $sira++;?>
            @endforeach
            <!-- Modal -->
            </tbody>
            <!-- Trigger the modal with a button -->
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

    </section><!-- right col -->
  </div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection
