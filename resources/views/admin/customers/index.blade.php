@extends('admin.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	@if (Session::has('flash_notification.message'))
		<script type="text/javascript">
            setTimeout(function () {
                updateApprove();
            },1000);
		</script>
@endif
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
   Müşteriler
    <small>Müşteri Listesi</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
    <li><a href="/admin/users"><i class="fa fa-dashboard active"></i> Üyeler</a></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-lg-12">
			@if($deleg['a']==1)
				<div class="col-lg-12">
					<a href="/admin/customers/create" class="button btn btn-primary">Yeni Müşteri</a>
				</div>
			@endif
			<div class="col-lg-12" style="margin:20px;"></div>
			<div class="col-lg-12">
			<div class="box box-primary" style="padding: 1%;">
			<div class="box-header">
				<h3 class="box-title">Müşteriler</h3>
			</div>
				<table class="table table-hover table-responsive" id="customers_table">
					<thead>
						<th>#</th>
						<th>İsim Soyisim</th>
						<th>Email</th>
						<th>GSM</th>
						<th>Adres</th>
						<th>Şirket Adı</th>
						<th>Sisteme Eklenme Tarihi</th>
					@if($deleg['u'] == 0 and $deleg['u'] == 0)
						@else
						<th>İşlemler</th>
					@endif
					</thead>
					<tbody>
					<?php $sira=1; ?>
					@foreach($data as $val)
						<tr>
							<td>{{$sira}}</td>
							<td>{{$val->name.' '.$val->surname}}</td>
							<td>{{$val->email}}</td>
							<td>{{$val->gsm}}</td>
							<td>{{$val->adres}}</td>
							<td>{{$val->companyName}}</td>
							<td>{{\Carbon\Carbon::parse($val->created_at)->format('d/m/Y')}}</td>
							@if($deleg['u'] == 0 and $deleg['u'] == 0)
							@else
								<td>
									@if($deleg['u'] == 1) <a href="/admin/customers/edit/{{$val->id}}" class="btn btn-success"><i class="fa fa-pencil-square-o"></i></a> @endif
									@if($deleg['d'] == 1) <a onclick="deleteApprove('/admin/customers/delete/{{$val->id}}')" class="btn btn-danger"><i class="fa fa-trash"></i></a> @endif
								</td>
							@endif
						</tr>
						<?php $sira++; ?>
					@endforeach	
					</tbody>
				</table>
			</div>
			</div>
			
		</div>
	</div>
</section><!-- /.content -->

</div><!-- /.content-wrapper -->
@endsection