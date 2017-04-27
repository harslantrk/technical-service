@extends('admin.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                MARKALAR
                <small>Marka Listesi</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
                <li><a href="/admin/brand"><i class="fa fa-dashboard active"></i> Markalar</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                @if($deleg['a']==1)
                    <div class="col-lg-12">
                        <a href="#" id="createBrand" class="button btn btn-primary" data-toggle="modal" data-target="#modalYeniMarka">Marka Ekle</a>
                    </div>
                @endif
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Markalar</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="brand_table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Marka</th>
                                    <th>Ekleyen</th>
                                    <th>Oluşturma Tarihi</th>
                                    <th>Güncelleme Tarihi</th>
                                    <th>İŞLEM</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1;?>
                                @foreach($brands as $brand)
                                    @if($brand->status == 1)
                                        <tr>
                                            <td>{{$no}}</td>
                                            <td>{{$brand->brand}}</td>
                                            <td>{{$brand->user->name}}</td>
                                            <td>{{\Carbon\Carbon::parse($brand->created_at)->format('d/m/Y')}}</td>
                                            <td>{{\Carbon\Carbon::parse($brand->updated_at)->format('d/m/Y H:i:s')}}</td>
                                            <td>
                                                @if($deleg['u']==1)<a href="/admin/brand/edit/{{$brand->id}}" class="button btn btn-success"><i class="fa fa-edit"></i></a>@endif
                                                @if($deleg['d']==1)<a onclick="deleteApprove('/admin/brand/delete/{{$brand->id}}')" class="button btn btn-danger"><i class="fa fa-trash"></i></a>@endif
                                            </td>
                                        </tr>
                                    @endif
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
    <!-- Randevu Ekleme Modeli -->
    <div class="modal fade" id="modalYeniMarka" tabindex="-1" role="dialog">

    </div>
    <!-- /.modal -->
@endsection
@section('jscode')
    <script>
        $('#createBrand').click(function () {
            var deger = 'a';
            /*console.log($(this).attr('name'));*/
            $.ajax({
                url: '/admin/brand/create',
                type: 'POST',
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf_token"]').attr('content');

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                cache: false,
                data: {deger: deger},
                success: function(data){
                    document.getElementById('modalYeniMarka').innerHTML=data;
                },
                error: function(jqXHR, textStatus, err){}
            });
        });
    </script>
@endsection