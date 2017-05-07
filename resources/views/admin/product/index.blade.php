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
            @if($deleg['a'] == 1)
              <div class="col-sm-12">
                <a href="{{URL::to('/admin/product/create')}}" class="btn btn-primary">Ürün Ekle</a>
              </div>
            @endif
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
                        <td>Tür</td>
                        <td>Stok</td>
                        <td>Çıkış Fiyatı</td>
                        <td>Son Güncelleme</td>
                        <td class="col-sm-2">İşlemler</td>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $sira = 1;?>
                      @foreach($products as $product)
                      <tr>
                        <th>{{$sira}}</th>
                        <th>{{$product->name}}</th>
                        <th>{{$product->brand->brand}}</th>
                        <th>{{$product->product_type->product_type}}</th>
                        @if($product->stock == 0)
                        <th>
                            <span class="text-red"><i class="fa fa-warning"></i> Stokda Yok</span>
                        </th>
                        @else
                        <th>{{$product->stock}}</th>
                        @endif
                        <th>{{$product->out_price}} <i class="fa fa-turkish-lira"></i></th>
                        <th>{{\Carbon\Carbon::parse($product->updated_at)->format('d/m/Y H:i:s')}}</th>
                        <th>
                          <a title="Görüntüle" href="/admin/product/show/{{$product->id}}" class="btn btn-primary">
                              <i class="fa fa-search"></i>
                          </a>
                          @if($deleg['u'] == 1)
                          <a title="Güncelle" href="/admin/product/edit/{{$product->id}}" class="btn btn-success">
                              <i class="fa fa-edit"></i>
                          </a>
                          @endif
                          @if($deleg['d'] == 1)
                          <a title="Sil" onclick="deleteApprove('/admin/product/delete/{{$product->id}}')" class="btn btn-danger">
                              <i class="fa fa-trash"></i>
                          </a>
                          @endif
                        </th>
                      </tr>
                      <?php $sira++;?>
                      @endforeach
                      <!-- Modal -->
                    </tbody>
                    <!-- Trigger the modal with a button -->
                  </table>
                  <div>
                    <a id="excel" href="{{URL::to('/admin/product/AllProductExcelExport')}}" class="btn btn-success"><i class="fa fa-file-excel-o"> Excel Çıktısı</i></a>
                      <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modalExcelImport"><i class="fa fa-file-excel-o"></i> Excel'den Ürün Al</a>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
  <!-- Ürüne Bileşen Ekleme Modeli -->
  <div class="modal fade" id="modalExcelImport" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <form action="{{URL::to('admin/product/ExcelImport')}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Sisteme Excel'den Ürün Yükle</h4>
                  </div>
                  <div class="modal-body">
                      <div class="box-body">
                          <div class="form-group">
                             <div class="btn btn-warning btn-file">
                                 <i class="fa fa-paperclip"></i> Excel Seç
                                 <input class="btn" type="file" name="excelImport" id="excelImport">
                             </div>
                              <button type="submit" class="btn btn-success" id="btnExcelImport" disabled>Excel'den Ürün Al</button>
                          </div>
                      </div><!-- /.box-body -->
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Kapat</button>
                  </div>
              </div><!-- /.modal-content -->
          </form>
      </div><!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endsection
@section('jscode')
  <script type="text/javascript">
      $(function() {
          $('#product_table_filter input').keyup(function () {
              var text = $('#product_table_filter input').val();
              var excel = document.getElementById('excel');
              console.log(text.length);
              if(text.length > 2){
                  excel.setAttribute('href','product/ExcelExport/' + text);
              }else{
                  excel.setAttribute('href','/admin/product/AllProductExcelExport');
              }
          });
          //Excel Dosya Kontrolü
          $('#excelImport').change(function () {
              var value = $('#excelImport').val();
              var file = value.split('.');
              var uzanti = file[file.length-1];
              var btnExcel = document.getElementById('btnExcelImport');

              if(uzanti == 'xlsx' || uzanti == 'xls'){
                  btnExcel.removeAttribute('disabled');
              }else{
                  sweetAlert('Geçersiz Dosya');
                  btnExcel.setAttribute('disabled','');
              }
          });
      });
  </script>
@endsection