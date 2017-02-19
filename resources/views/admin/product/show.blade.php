@extends('admin.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{$products->name}} Ürünü Görüntüleniyor
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/admin')}}"><i class="fa fa-dashboard"></i> Anasayfa</a></li>
                <li><a href="{{URL::to('/admin/product/')}}">Ürünler</a></li>
                <li class="active">Tüm Ürünler</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Yeni Ürün Ekleme</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <!-- form start -->
                    <form role="form" method="post" id="kapat" action="{{URL::to('/admin/product/update/')}}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="control-label">Ürün Adı</label>
                            <input type="text" class="form-control" name="name" value="{{$products->name}}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Marka</label>
                            <select name="brand_id" class="select2 form-control" style="width: 100%;">
                                <option disabled>Marka Seçiniz</option>
                                @foreach($brands as $brand)
                                    @if($products->brand_id == $brand->id)
                                        <option selected value="{{$brand->id}}">{{$brand->brand}}</option>
                                    @else
                                        <option value="{{$brand->id}}">{{$brand->brand}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Ürün Türü</label>
                            <select name="product_type_id" class="select2 form-control" style="width: 100%;">
                                <option disabled>Ürün Türü Seçiniz</option>
                                @foreach($product_types as $product_type)
                                    @if($products->product_type_id == $product_type->id)
                                        <option selected value="{{$product_type->id}}">{{$product_type->product_type}}</option>
                                    @else
                                        <option value="{{$product_type->id}}">{{$product_type->product_type}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Ürün Açıklaması</label>
                            <textarea class="form-control" style="resize: none;" name="detail"  cols="30" rows="10">{{$products->detail}}</textarea>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Ürün Stoğu</label>
                                <input type="number" class="form-control" name="stock" value="{{$products->stock}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Ürün Geliş Fiyatı</label>
                                <input type="number" class="form-control" name="in_price" value="{{$products->in_price}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Ürün Çıkış Fiyatı</label>
                                <input type="number" class="form-control" name="out_price" value="{{$products->out_price}}">
                            </div>
                            <a href="{{URL::to('/admin/product/')}}" class="button btn btn-default"><i class="fa fa-undo"></i> Geri</a>
                        </div>
                    </form>
                    <div class="col-sm-3 col-xs-6">
                        <label class="control-label">Ürün Resmi</label>
                        @if($products->image)
                            <img style="margin: 0px;" class="img-bordered img-responsive" src="{{URL::to($products->image)}}" alt="User profile picture">
                        @endif
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block">
                        <h3>Ürün Yorumları</h3>
                    </div><!-- /.user-block -->
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" title="Kapat"><i class="fa fa-times"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-footer box-comments" style="display: block;">
                    @if($comments->count()>0)
                        @foreach($comments as $comment)
                            <div class="box-comment">
                                <!-- User image -->
                                @if($comment->user->picture)
                                    <img class="img-responsive img-circle img-sm" src="{{$comment->user->picture}}" alt="alt text">
                                @else
                                    <img class="img-responsive img-circle img-sm" src="{{URL::to('/img/avatar.png')}}" alt="alt text">
                                @endif
                                <div class="comment-text">
                              <span class="username">
                                  <a href="/admin/users/commentShow/{{$comment->user->id}}">{{$comment->user->name}}</a>
                                <span class="text-muted pull-right">{{\Carbon\Carbon::parse($comment->created_at)->format('d/m/Y H:i')}}</span>
                              </span><!-- /.username -->
                                   {{$comment->comment}}
                                </div><!-- /.comment-text -->
                                <div id="commentThought">
                                    <?php
                                    $usersCom = $comment->users_comment;
                                    $usersCom = json_decode($usersCom);
                                    $gizle = "";
                                    foreach($usersCom as $key=>$value)
                                    {
                                        if ($value == \Illuminate\Support\Facades\Auth::user()->id) {
                                            $gizle=1;
                                        }
                                    }
                                    ?>
                                    @if($gizle != 1)
                                            <button class="btn btn-danger btn-xs thought" data-id="{{$comment->id}}" id="0"><i class="fa fa-thumbs-o-down"></i> Olumsuz</button>
                                            <button class="btn btn-success btn-xs thought" data-id="{{$comment->id}}" id="1"><i class="fa fa-thumbs-o-up"></i> Olumlu</button>
                                        @endif
                                </div>
                            </div><!-- /.box-comment -->
                            @endforeach
                        @else
                        <h3>Henüz Yorum Yapılmamış. İlk Yorumu Yapan Siz Olun.</h3>
                        @endif
                </div><!-- /.box-footer -->
                <div class="box-footer" style="display: block;">
                        @if(Auth::user()->picture)
                            <img class="img-responsive img-circle img-sm" src="{{Auth::user()->picture}}" alt="alt text">
                            @else
                            <img class="img-responsive img-circle img-sm" src="{{URL::to('/img/avatar.png')}}" alt="alt text">
                            @endif
                        <!-- .img-push is used to add margin to elements next to floating images -->
                        <div class="img-push">
                            <input type="text" id="yorumText" onkeydown="uniKeyCode(event)" class="form-control input-sm" placeholder="Yorumu Göndermek İçin Enter'a Basınız...">
                        </div>
                </div><!-- /.box-footer -->
            </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <script type="text/javascript">
        //form içindeki elementleri kapatma
        // ara inputunu aldıgından dolayı 2 den baslıyor
        var a = $('#kapat >div textarea,input,select');
        for(var i=2;i<9;i++){
            console.log('asd');
            a[i].setAttribute('disabled','');
        }
        $('.thought').click(function () {
            var parent = this.parentNode;
            parent.style.display='none';
            console.log(this.parentNode);
            var thought = $(this).attr('id');
            var comment_id =  $(this).attr('data-id');
            console.log(thought + '-' +comment_id);
            $.ajax({
             url: '/admin/product/commentThought',
             type: 'POST',
             beforeSend: function (xhr) {
             var token = $('meta[name="csrf_token"]').attr('content');

             if (token) {
             return xhr.setRequestHeader('X-CSRF-TOKEN', token);
             }
             },
             cache: false,
             data: {thought:thought,comment_id:comment_id},
             success: function(data){
                 location.reload();
             },
             error: function(jqXHR, textStatus, err){}
             });
        });
        function uniKeyCode(event) {
            if(event.keyCode==13){
                var comment = $('#yorumText').val();
                var product_id = '{{$products->id}}';
                $.ajax({
                    url: '/admin/product/commentSave',
                    type: 'POST',
                    beforeSend: function (xhr) {
                        var token = $('meta[name="csrf_token"]').attr('content');

                        if (token) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    },
                    cache: false,
                    data: {comment:comment,product_id:product_id},
                    success: function(data){
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, err){}
                });

            }
        }
    </script>
@endsection