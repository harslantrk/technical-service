@extends('admin.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Müşteriler
    <small>Müşteri Bilgilerini Düzenle</small>
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
          <h3 class="box-title">{{$customers->name}} {{$customers->surname}} Müşterisinin Bilgilerini Düzenle</h3>
        </div>
        <div class=box-body>
            <form class="form-horizontal" method="post" action="{{URL::to('/admin/customers/update')}}">
                {!! csrf_field() !!}
                <input type="hidden" class="form-control" name="id" value="{{$customers->id}}">
                <div class="form-group">
                    <label class="control-label">Adı</label>
                    <input type="text" class="form-control" name="name" value="{{$customers->name}}">
                </div>
                <div class="form-group">
                    <label class="control-label">Soyadı</label>
                    <input type="text" class="form-control" name="surname" value="{{$customers->surname}}">
                </div>
                <div class="form-group">
                    <label class="control-label">E-Mail</label>
                    <input type="email" class="form-control" name="email" value="{{$customers->email}}">
                </div>
                <div class="form-group">
                    <label class="control-label">Telefon</label>
                    <input type="text" class="form-control" name="phone" value="{{$customers->phone}}">
                </div>
                <div class="form-group">
                    <label class="control-label">Gsm</label>
                    <input type="text" class="form-control" name="gsm" value="{{$customers->gsm}}">
                </div>
                <div class="form-group">
                    <label class="control-label">Adres</label>
                    <input type="text" class="form-control" name="adres" value="{{$customers->adres}}">
                </div>
                <div class="form-group">
                    <label class="control-label">Şirket Adı</label>
                    <input type="text" class="form-control" name="companyName" value="{{$customers->companyName}}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-hdd-o"></i> Güncelle</button>
                </div>
            </form>
      </div>
      </div>
      
		</div>
	</div>
</section><!-- /.content -->

</div><!-- /.content-wrapper -->
@endsection