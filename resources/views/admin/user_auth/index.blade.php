@extends('admin.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Kullanıcı Yetkilendirme
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/admin')}}"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
                <li class="active">Kullanıcı Yetkileri</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="box box-danger">
                <div class="box-body">
                    <form method="post" action="{{URL::to('/admin/user_auth/saveAuth')}}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="control-label">Kullanıcılar</label>
                            <select onchange="yetki_getir()" id="user_id" name="user_id" class="select2 form-control" style="width: 100%">
                                <option selected disabled>Kullanıcı Seç</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name.' '.$user->surname}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" id="auth" style="display: none;">
                            <label class="control-label">Yetkiler</label>
                            <select id="delegation_id" name="delegation_id" class="select2 form-control" style="width: 100%">
                                <option selected disabled>Yetki Seç</option>
                                @foreach($delegations as $delegation)
                                        <option value="{{$delegation->id}}">{{$delegation->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button id="saveAuth" type="submit" class="btn btn-success" style="display: none;">Kaydet</button>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection
@section('jscode')
    <script type="text/javascript">
        function yetki_getir() {
            $('#auth').removeAttr('style');
            $('#saveAuth').removeAttr('style');
        }
    </script>
    @endsection