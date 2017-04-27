<div class="modal-dialog" role="document">
    <form role="form" action="{{URL::to('/admin/product_type/save')}}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Yeni Ürün Türü Ekle</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="form-group">
                        <label>Ürün Türü</label>
                        <input class="form-control" type="text" name="product_type">
                    </div>
                </div><!-- /.box-body -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                <button id="product_typeSaveBtn" type="submit" class="btn btn-primary">Ürün Türü Ekle</button>
            </div>
        </div><!-- /.modal-content -->
    </form>
</div><!-- /.modal-dialog -->