@extends('admin.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Müşteriler
    <small>Yeni Müşteri Ekle</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
    <li><a href="/admin/customers"><i class="fa fa-dashboard active"></i> Müşteriler</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">	
  <div class="row">
		<div class="col-lg-12">
            <div class="box box-primary" style="padding: 1%">
                <div class="box-header with-border" style="margin-bottom: 1%">
                  <h3 class="box-title">Yeni Müşteri Ekle</h3>
                </div>
                <div class=box-body>
                    <form class="form-horizontal" method="post" action="{{URL::to('/admin/customers/save')}}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="control-label">Adı</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Soyadı</label>
                            <input type="text" class="form-control" name="surname">
                        </div>
                        <div class="form-group">
                            <label class="control-label">E-Mail</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Telefon</label>
                            <input type="text" class="form-control" name="phone">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Gsm</label>
                            <input type="text" class="form-control" name="gsm">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Adres</label>
                            <input type="text" class="form-control" name="adres">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Şirket Adı</label>
                            <input type="text" class="form-control" name="companyName">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-hdd-o"></i> Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
		</div>
	</div>
</section><!-- /.content -->

</div><!-- /.content-wrapper -->
@endsection