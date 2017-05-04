<div class="modal-dialog" role="document">
    <form role="form" action="{{URL::to('/admin/product/ProductJoinSave')}}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Bileşen Ekle</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="form-group">
                        <label>Eklenen</label>
                        <input class="form-control" type="text" value="{{$product_one->name}}" disabled>
                        <input type="hidden" name="product_id" value="{{$product_one->id}}">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ürün Seçiniz</label>
                        <select name="twoproduct_id" class="select2 form-control" style="width: 100%;">
                            @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Adet</label>
                        <input class="form-control" type="number" name="quantity">
                    </div>
                </div><!-- /.box-body -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                <button id="joinSaveBtn" type="submit" class="btn btn-primary">Bileşen Ekle</button>
            </div>
        </div><!-- /.modal-content -->
    </form>
</div><!-- /.modal-dialog -->