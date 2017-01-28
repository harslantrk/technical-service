@extends('admin.master')

@section('content')
  @if($deleg['u'] == 0 && $deleg['d'] == 0 && $deleg['a'] == 0)
    <script type="text/javascript">
      alert('Sadece Görüntüleme Yetkisine Sahipsiniz !');
    </script>
  @endif
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Tüm Ürünler
           @if($deleg['a'] == 1)
              <a href="{{URL::to('/admin/product/create')}}" class="btn btn-primary">Ürün Ekle</a>
           @endif
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/admin')}}"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
            <li><a href="{{URL::to('/admin/product/')}}">Ürünler</a></li>
            <li class="active">Tüm Ürünler</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12 col-sm-12">
              <div class="box">
                <!--<div class="box-header">
                  <h3 class="box-title">Data Table With Full Features</h3>
                </div>< /.box-header -->
                <div class="box-body">
                  <table id="product_table" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td>#</td>
                        <td>Ürün Adı</td>
                        <td>Marka</td>
                        <td>Stok</td>
                        <td>Çıkış Fiyatı</td>
                        <td>Son Güncelleme</td>
                        <td>İşlemler</td>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $sira = 1;?>
                      @foreach($products as $product)
                      <tr>
                        <th>{{$sira}}</th>
                        <th>{{$product->name}}</th>
                        <th>{{$product->brand->brand}}</th>
                        <th>{{$product->stock}}</th>
                        <th>{{$product->out_price}}</th>
                        <th>{{\Carbon\Carbon::parse($product->updated_at)->format('d/m/Y H:i:s')}}</th>
                        <th>
                          <a title="Güncelle" href="/admin/product/show/{{$product->id}}" class="btn btn-primary"><i class="fa fa-search"></i></a>
                          @if($deleg['u'] == 1)<a title="Güncelle" href="/admin/product/edit/{{$product->id}}" class="btn btn-success"><i class="fa fa-edit"></i></a>@endif
                          @if($deleg['d'] == 1)<a title="Sil" onclick="deleteApprove('/admin/product/delete/{{$product->id}}')" class="btn btn-danger"><i class="fa fa-trash"></i></a> @endif
                        </th>
                      </tr>
                      <?php $sira++;?>
                      @endforeach
                      <!-- Modal -->
                    </tbody>
                    <!-- Trigger the modal with a button -->
                  </table>
                  <div>
                    <a href="/admin/product/AllProductExcelExport" class="btn btn-success"><i class="fa fa-file-excel-o"> Excel Çıktısı</i></a>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection