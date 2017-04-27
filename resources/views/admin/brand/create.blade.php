<div class="modal-dialog" role="document">
    <form role="form" action="{{URL::to('/admin/brand/save')}}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Yeni Marka Ekle</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <div class="form-group">
                        <label>Marka</label>
                        <input class="form-control" type="text" name="brand">
                    </div>
                </div><!-- /.box-body -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                <button id="brandSaveBtn" type="submit" class="btn btn-primary">Marka Ekle</button>
            </div>
        </div><!-- /.modal-content -->
    </form>
</div><!-- /.modal-dialog -->